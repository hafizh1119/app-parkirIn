<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LokasiParkir;
use Illuminate\Http\Request;

class LokasiParkirController extends Controller
{
    public function index()
{
    $lokasiParkir = LokasiParkir::withCount('areaParkir')
        ->withCount('slotParkir') 
        ->withCount(['slotParkir as slot_tersedia_count' => function ($query) {
            $query->where('slot_parkir.status', 'tersedia');
        }])
        ->latest()
        ->paginate(10);

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
            'link_maps' => 'required|string|max:500',
            'gambar' => 'required|image',
            'deskripsi' => 'nullable',
        ]);

        $file = $request->file('gambar');
        $namaFile = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('assets/img/lokasi'), $namaFile);
        $data['gambar'] = 'assets/img/lokasi/' . $namaFile;

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
            'link_maps' => 'required|string|max:500',
            'gambar' => 'nullable|image',
            'deskripsi' => 'nullable',
        ]);

        if ($request->hasFile('gambar')) {
            // hapus gambar lama kalau ada
            if ($lokasi->gambar && file_exists(public_path($lokasi->gambar))) {
                unlink(public_path($lokasi->gambar));
            }

            $file = $request->file('gambar');
            $namaFile = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('assets/img/lokasi'), $namaFile);
            $data['gambar'] = 'assets/img/lokasi/' . $namaFile;
        } else {
            // gak upload gambar baru, tetap pakai yang lama
            $data['gambar'] = $lokasi->gambar;
        }

        $lokasi->update($data);

        return redirect()
            ->route('admin.lokasi-parkir.index')
            ->with('success', 'Lokasi parkir berhasil diperbarui');
    }

    public function destroy($id)
    {
        $lokasi = LokasiParkir::findOrFail($id);

        if ($lokasi->gambar && file_exists(public_path($lokasi->gambar))) {
            unlink(public_path($lokasi->gambar));
        }

        $lokasi->delete();

        return redirect()
            ->route('admin.lokasi-parkir.index')
            ->with('success', 'Lokasi parkir berhasil dihapus');
    }
}