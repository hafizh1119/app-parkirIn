<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LokasiParkir;
use App\Models\SlotParkir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class LokasiParkirController extends Controller
{
    public function index()
    {
        $lokasiParkir = LokasiParkir::withCount('slotParkir')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('admin.lokasi-parkir.index', compact('lokasiParkir'));
    }

    public function create()
    {
        return view('admin.lokasi-parkir.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'link_maps' => 'nullable|url|max:500',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'deskripsi' => 'nullable|string',
        ]);

        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $namaGambar = Str::slug($request->nama) . '-' . time() . '.' . $gambar->getClientOriginalExtension();
            $gambar->storeAs('public/lokasi-parkir', $namaGambar);
            $gambarPath = 'storage/lokasi-parkir/' . $namaGambar;
        }

        LokasiParkir::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'link_maps' => $request->link_maps,
            'gambar' => $gambarPath,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('admin.lokasi-parkir.index')
            ->with('success', 'Lokasi parkir berhasil ditambahkan!');
    }

    public function show($id)
    {
        $lokasi = LokasiParkir::findOrFail($id);
        
        $totalSlots = SlotParkir::where('lokasi_parkir_id', $id)->count();
        $availableSlots = SlotParkir::where('lokasi_parkir_id', $id)->where('status', 'tersedia')->count();
        $occupiedSlots = SlotParkir::where('lokasi_parkir_id', $id)->where('status', 'terisi')->count();
        
        $areas = SlotParkir::where('lokasi_parkir_id', $id)
            ->selectRaw('area, 
                jenis_kendaraan, 
                COUNT(*) as total_slot,
                SUM(CASE WHEN status = "terisi" THEN 1 ELSE 0 END) as terisi,
                MAX(tarif_per_jam) as tarif_per_jam')
            ->groupBy('area', 'jenis_kendaraan')
            ->get();
        
        $totalAreas = SlotParkir::where('lokasi_parkir_id', $id)
            ->distinct('area')
            ->count('area');
        
        return view('admin.lokasi-parkir.show', compact(
            'lokasi', 
            'totalSlots', 
            'availableSlots', 
            'occupiedSlots', 
            'areas', 
            'totalAreas'
        ));
    }

    public function edit($id)
    {
        $lokasi = LokasiParkir::findOrFail($id);
        return view('admin.lokasi-parkir.edit', compact('lokasi'));
    }

    public function update(Request $request, $id)
    {
        $lokasi = LokasiParkir::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'link_maps' => 'nullable|url|max:500',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'deskripsi' => 'nullable|string',
        ]);

        $data = [
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'link_maps' => $request->link_maps,
            'deskripsi' => $request->deskripsi,
        ];

        if ($request->hasFile('gambar')) {
            if ($lokasi->gambar && file_exists(public_path($lokasi->gambar))) {
                $oldPath = str_replace('storage/', 'public/', $lokasi->gambar);
                Storage::delete($oldPath);
            }

            $gambar = $request->file('gambar');
            $namaGambar = Str::slug($request->nama) . '-' . time() . '.' . $gambar->getClientOriginalExtension();
            $gambar->storeAs('public/lokasi-parkir', $namaGambar);
            $data['gambar'] = 'storage/lokasi-parkir/' . $namaGambar;
        }

        $lokasi->update($data);

        return redirect()->route('admin.lokasi-parkir.index')
            ->with('success', 'Lokasi parkir berhasil diupdate!');
    }

    public function destroy($id)
    {
        $lokasi = LokasiParkir::findOrFail($id);
        
        if ($lokasi->gambar && file_exists(public_path($lokasi->gambar))) {
            $oldPath = str_replace('storage/', 'public/', $lokasi->gambar);
            Storage::delete($oldPath);
        }

        $lokasi->delete();

        return redirect()->route('admin.lokasi-parkir.index')
            ->with('success', 'Lokasi parkir berhasil dihapus!');
    }

    /**
     * Kelola Slot Parkir dengan Search & Filter
     */
    public function kelolaSlot(Request $request, $id)
    {
        $lokasi = LokasiParkir::findOrFail($id);
        
        $query = SlotParkir::where('lokasi_parkir_id', $id);
        
        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('kode_slot', 'like', '%' . $request->search . '%')
                  ->orWhere('area', 'like', '%' . $request->search . '%');
            });
        }
        
        if ($request->jenis) {
            $query->where('jenis_kendaraan', $request->jenis);
        }
        
        if ($request->status_filter) {
            $query->where('status', $request->status_filter);
        }
        
        $slots = $query->paginate(15);
        
        return view('admin.lokasi-parkir.kelola-slot', compact('lokasi', 'slots'));
    }

    public function storeSlot(Request $request, $id)
    {
        $existing = SlotParkir::where('lokasi_parkir_id', $id)
            ->where('kode_slot', $request->kode_slot)
            ->first();
        
        if ($existing) {
            return redirect()->back()
                ->with('error', 'Kode slot "' . $request->kode_slot . '" sudah ada di lokasi ini!')
                ->withInput();
        }

        $request->validate([
            'kode_slot' => 'required|string|max:20',
            'area' => 'required|string|max:10',
            'jenis_kendaraan' => 'required|in:mobil,motor',
            'tarif_per_jam' => 'required|numeric|min:0',
            'status' => 'required|in:tersedia,terisi',
        ]);

        SlotParkir::create([
            'lokasi_parkir_id' => $id,
            'kode_slot' => $request->kode_slot,
            'area' => $request->area,
            'jenis_kendaraan' => $request->jenis_kendaraan,
            'tarif_per_jam' => $request->tarif_per_jam,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.lokasi-parkir.kelola-slot', $id)
            ->with('success', 'Slot parkir berhasil ditambahkan!');
    }

    public function destroySlot($id, $slotId)
    {
        $slot = SlotParkir::where('lokasi_parkir_id', $id)->findOrFail($slotId);
        $slot->delete();

        return redirect()->route('admin.lokasi-parkir.kelola-slot', $id)
            ->with('success', 'Slot parkir berhasil dihapus!');
    }

    public function updateSlotStatus(Request $request, $id, $slotId)
    {
        $slot = SlotParkir::where('lokasi_parkir_id', $id)->findOrFail($slotId);
        $slot->update([
            'status' => $request->status,
        ]);

        return response()->json(['success' => true, 'message' => 'Status slot berhasil diupdate!']);
    }

    /**
     * Toggle Slot Status (Tersedia -> Terisi, atau sebaliknya)
     * Digunakan untuk tombol pensil di kelola-slot
     */
    public function toggleSlotStatus($id, $slotId)
    {
        $slot = SlotParkir::where('lokasi_parkir_id', $id)->findOrFail($slotId);
        
        $slot->update([
            'status' => $slot->status == 'tersedia' ? 'terisi' : 'tersedia'
        ]);

        return redirect()->route('admin.lokasi-parkir.kelola-slot', $id)
            ->with('success', 'Status slot ' . $slot->kode_slot . ' berhasil diubah menjadi ' . $slot->status);
    }

    public function createArea($id)
    {
        $lokasi = LokasiParkir::findOrFail($id);
        
        $totalSlots = SlotParkir::where('lokasi_parkir_id', $id)->count();
        $availableSlots = SlotParkir::where('lokasi_parkir_id', $id)->where('status', 'tersedia')->count();
        $occupiedSlots = SlotParkir::where('lokasi_parkir_id', $id)->where('status', 'terisi')->count();
        
        return view('admin.lokasi-parkir.create-area', compact('lokasi', 'totalSlots', 'availableSlots', 'occupiedSlots'));
    }

    public function storeArea(Request $request, $id)
    {
        $request->validate([
            'area' => 'required|string|max:10',
            'jenis_kendaraan' => 'required|in:mobil,motor',
            'jumlah_slot' => 'required|integer|min:1|max:100',
            'tarif_per_jam' => 'required|numeric|min:0',
            'status' => 'required|in:tersedia,terisi',
        ]);

        $lokasi = LokasiParkir::findOrFail($id);
        
        $existingSlots = SlotParkir::where('lokasi_parkir_id', $id)
            ->pluck('kode_slot')
            ->toArray();
        
        $created = 0;
        $skipped = 0;
        
        for ($i = 1; $i <= $request->jumlah_slot; $i++) {
            $kodeSlot = strtoupper($request->area) . str_pad($i, 2, '0', STR_PAD_LEFT);
            
            if (in_array($kodeSlot, $existingSlots)) {
                $skipped++;
                continue;
            }
            
            SlotParkir::create([
                'lokasi_parkir_id' => $id,
                'kode_slot' => $kodeSlot,
                'area' => strtoupper($request->area),
                'jenis_kendaraan' => $request->jenis_kendaraan,
                'tarif_per_jam' => $request->tarif_per_jam,
                'status' => $request->status,
            ]);
            $created++;
        }

        $message = 'Area ' . strtoupper($request->area) . ' berhasil ditambahkan! ' . $created . ' slot baru dibuat.';
        if ($skipped > 0) {
            $message .= ' ' . $skipped . ' slot dilewati karena sudah ada.';
        }

        return redirect()->route('admin.lokasi-parkir.show', $id)
            ->with('success', $message);
    }

    public function bulkStoreSlot(Request $request, $id)
    {
        $lokasi = LokasiParkir::findOrFail($id);
        
        $request->validate([
            'prefix' => 'required|string|max:5',
            'start_from' => 'required|integer|min:1',
            'jumlah' => 'required|integer|min:1|max:50',
            'area' => 'required|string|max:10',
            'jenis_kendaraan' => 'required|in:mobil,motor',
            'tarif_per_jam' => 'required|numeric|min:0',
            'status' => 'required|in:tersedia,terisi'
        ]);
        
        $jumlah = $request->jumlah;
        $prefix = $request->prefix;
        $start = $request->start_from;
        $created = 0;
        $skipped = 0;
        
        $existingSlots = SlotParkir::where('lokasi_parkir_id', $id)
            ->pluck('kode_slot')
            ->toArray();
        
        for ($i = $start; $i < $start + $jumlah; $i++) {
            $kode = $prefix . $i;
            
            if (in_array($kode, $existingSlots)) {
                $skipped++;
                continue;
            }
            
            SlotParkir::create([
                'lokasi_parkir_id' => $lokasi->id,
                'kode_slot' => $kode,
                'area' => $request->area,
                'jenis_kendaraan' => $request->jenis_kendaraan,
                'tarif_per_jam' => $request->tarif_per_jam,
                'status' => $request->status,
            ]);
            
            $created++;
        }
        
        $message = "Berhasil membuat {$created} slot baru";
        if ($skipped > 0) {
            $message .= ", {$skipped} slot dilewati (kode sudah ada)";
        }
        
        return redirect()->route('admin.lokasi-parkir.kelola-slot', $lokasi->id)
            ->with('success', $message);
    }
}