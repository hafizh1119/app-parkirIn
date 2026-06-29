<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AreaParkir;
use App\Models\SlotParkir;
use Illuminate\Http\Request;

class SlotParkirController extends Controller
{
    public function index(AreaParkir $area)
    {
        $slots = SlotParkir::with([
            'reservasi' => function ($query) {
                $query->with('kendaraan');
            }
        ])
        ->where('area_parkir_id', $area->id)
        ->get();

        $totalSlot = $slots->count();

        $slotTerisi = $slots->filter(function ($slot) {
            return $slot->status_tampil === 'terisi';
        })->count();

        $kapasitas = $totalSlot > 0
            ? round(($slotTerisi / $totalSlot) * 100)
            : 0;

        return view(
            'Admin.slot-parkir.index',
            compact(
                'area',
                'slots',
                'totalSlot',
                'slotTerisi',
                'kapasitas'
            )
        );
    }

    public function store(Request $request, AreaParkir $area)
    {
        $request->validate([
            'kode_slot' => 'required|string|unique:slot_parkir,kode_slot',
            'status'    => 'required|in:tersedia,terisi',
        ]);

        $area->slotParkir()->create([
            'kode_slot'        => $request->kode_slot,
            'status'           => $request->status,
            'lokasi_parkir_id' => $area->lokasi_parkir_id,
            'jenis_kendaraan'  => $area->jenis_kendaraan,
            'tarif_per_jam'    => $area->tarif_per_jam,
        ]);

        return redirect()->route('admin.slot-parkir.index', $area->id)
            ->with('success', 'Slot berhasil ditambahkan');
    }

    public function update(Request $request, AreaParkir $area, SlotParkir $slot)
    {
        $request->validate([
            'status' => 'required|in:kosong,terisi',
        ]);

        $slot->update(['status' => $request->status]);

        return redirect()->route('admin.slot-parkir.index', $area->id)
            ->with('success', 'Status slot berhasil diperbarui');
    }

    public function destroy(AreaParkir $area, SlotParkir $slot)
    {
        $slot->delete();

        return redirect()->route('admin.slot-parkir.index', $area->id)
            ->with('success', 'Slot berhasil dihapus');
    }
}