<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AreaParkir;
use App\Models\LokasiParkir;
use Illuminate\Http\Request;

class AreaParkirController extends Controller
{
    public function index(LokasiParkir $lokasi)
    {
        $areas = AreaParkir::with('slotParkir')
            ->where('lokasi_parkir_id', $lokasi->id)
            ->get();

        return view('Admin.slot-area.index', compact('lokasi', 'areas'));
    }

    public function create(LokasiParkir $lokasi)
    {
        return view('Admin.slot-area.create', compact('lokasi'));
    }

    public function store(Request $request, LokasiParkir $lokasi)
    {
        $request->validate([
            'nama_area' => 'required',
            'jenis_kendaraan' => 'required',
            'kapasitas' => 'required|integer|min:1',
            'tarif_per_jam' => 'required|numeric',
            'status' => 'required',
            'deskripsi' => 'nullable',
        ]);

        $area = $lokasi->areaParkir()->create($request->all());

        for ($i = 1; $i <= $area->kapasitas; $i++) {
            $area->slotParkir()->create([
                'kode_slot' => $area->nama_area . '-' . str_pad($i, 2, '0', STR_PAD_LEFT),
                'status' => 'tersedia',
            ]);
        }

        return redirect()
            ->route('admin.slot-area.index', $lokasi->id)
            ->with('success', 'Area parkir berhasil ditambahkan');
    }

    public function edit(LokasiParkir $lokasi, AreaParkir $area)
    {
        return view('Admin.slot-area.edit', compact('lokasi', 'area'));
    }

    public function update(Request $request, LokasiParkir $lokasi, AreaParkir $area)
    {
        $request->validate([
            'nama_area' => 'required',
            'jenis_kendaraan' => 'required',
            'kapasitas' => 'required|integer|min:1',
            'tarif_per_jam' => 'required|numeric',
            'status' => 'required',
            'deskripsi' => 'nullable',
        ]);

        $area->update($request->all());

        $kapasitasBaru = $area->kapasitas;
        $jumlahSlotSekarang = $area->slotParkir()->count();

        if ($kapasitasBaru > $jumlahSlotSekarang) {
            // Kurang slot -> generate tambahan
            for ($i = $jumlahSlotSekarang + 1; $i <= $kapasitasBaru; $i++) {
                $area->slotParkir()->create([
                    'kode_slot' => $area->nama_area . '-' . str_pad($i, 2, '0', STR_PAD_LEFT),
                    'status' => 'tersedia',
                ]);
            }
        } elseif ($kapasitasBaru < $jumlahSlotSekarang) {
            // Kelebihan slot -> hapus yang masih 'tersedia' aja
            $jumlahHapus = $jumlahSlotSekarang - $kapasitasBaru;

            $slotDihapus = $area->slotParkir()
                ->where('status', 'tersedia')
                ->orderByDesc('id')
                ->limit($jumlahHapus)
                ->get();

            foreach ($slotDihapus as $slot) {
                $slot->delete();
            }
        }

        return redirect()
            ->route('admin.slot-area.index', $lokasi->id)
            ->with('success', 'Area parkir berhasil diperbarui');
    }

    public function destroy(LokasiParkir $lokasi, AreaParkir $area)
    {
        $area->slotParkir()->delete();
        $area->delete();

        return redirect()
            ->route('admin.slot-area.index', $lokasi->id)
            ->with('success', 'Area parkir berhasil dihapus');
    }
}