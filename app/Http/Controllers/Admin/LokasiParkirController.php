<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LokasiParkir;
use Illuminate\Http\Request;

class LokasiParkirController extends Controller
{
    public function index()
    {
        $lokasiParkir = LokasiParkir::withCount('areaParkir')->latest()->get();

        return view('Admin.lokasi-parkir.index', compact('lokasiParkir'));
    }

    public function create()
    {
        return view('Admin.lokasi-parkir.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'link_maps' => 'nullable',
            'gambar' => 'nullable|image',
            'deskripsi' => 'nullable',
        ]);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request
                ->file('gambar')
                ->store('lokasi-parkir', 'public');
        }

        LokasiParkir::create($data);

        return redirect()
            ->route('admin.lokasi-parkir.index')
            ->with('success', 'Lokasi parkir berhasil ditambahkan');
    }

    public function edit($id)
    {
        $lokasi = LokasiParkir::findOrFail($id);

        return view('Admin.lokasi-parkir.edit', compact('lokasi'));
    }

    public function update(Request $request, $id)
    {
        $lokasi = LokasiParkir::findOrFail($id);

        $data = $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'link_maps' => 'nullable',
            'gambar' => 'nullable|image',
            'deskripsi' => 'nullable',
        ]);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request
                ->file('gambar')
                ->store('lokasi-parkir', 'public');
        }

        $lokasi->update($data);

        return redirect()
            ->route('admin.lokasi-parkir.index')
            ->with('success', 'Lokasi parkir berhasil diperbarui');
    }

    public function destroy($id)
    {
        $lokasi = LokasiParkir::findOrFail($id);

        $lokasi->delete();

        return redirect()
            ->route('admin.lokasi-parkir.index')
            ->with('success', 'Lokasi parkir berhasil dihapus');
    }
}