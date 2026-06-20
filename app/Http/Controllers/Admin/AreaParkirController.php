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
            'kapasitas' => 'required|integer',
            'tarif_per_jam' => 'required|numeric',
            'status' => 'required',
            'deskripsi' => 'nullable',
        ]);

        $lokasi->areaParkir()->create($request->all());

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
            'kapasitas' => 'required|integer',
            'tarif_per_jam' => 'required|numeric',
            'status' => 'required',
            'deskripsi' => 'nullable',
        ]);

        $area->update($request->all());

        return redirect()
            ->route('admin.slot-area.index', $lokasi->id)
            ->with('success', 'Area parkir berhasil diperbarui');
    }

    public function destroy(LokasiParkir $lokasi, AreaParkir $area)
    {
        $area->delete();

        return redirect()
            ->route('admin.slot-area.index', $lokasi->id)
            ->with('success', 'Area parkir berhasil dihapus');
    }
}