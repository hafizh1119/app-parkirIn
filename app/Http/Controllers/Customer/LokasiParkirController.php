<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\LokasiParkir;
use App\Models\SlotParkir;
use App\Models\AreaParkir;
use Illuminate\Http\Request;
use App\Models\Kendaraan;

class LokasiParkirController extends Controller
{
    public function index()
    {
        $lokasiParkir = LokasiParkir::with('areaParkir.slotParkir')->get();

        foreach ($lokasiParkir as $lokasi) {
            // Ambil semua slot dari semua area di lokasi ini
            $semuaSlot = $lokasi->areaParkir->flatMap->slotParkir;

            $lokasi->slot_mobil = $semuaSlot
                ->where('jenis_kendaraan', 'mobil')
                ->where('status', 'tersedia')
                ->count();

            $lokasi->slot_motor = $semuaSlot
                ->where('jenis_kendaraan', 'motor')
                ->where('status', 'tersedia')
                ->count();
        }

        return view('customers.cari-parkir', compact('lokasiParkir'));
    }

    public function show(string $id)
    {
        $lokasi = LokasiParkir::findOrFail($id);

        return view('customers.denah', compact('lokasi'));
    }

    public function aturJadwal($id)
    {
        $lokasi = LokasiParkir::findOrFail($id);

        return view('customers.atur-jadwal', compact('lokasi'));
    }

    public function denah(Request $request)
    {
        $lokasi = LokasiParkir::findOrFail($request->lokasi_parkir_id);

        $kendaraan = Kendaraan::where('user_id', Auth::id())->first();

        // Ambil area sesuai jenis kendaraan
        $areas = AreaParkir::where('lokasi_parkir_id', $request->lokasi_parkir_id)
            ->where('jenis_kendaraan', $request->kendaraan)
            ->get();

        $slotParkir = SlotParkir::with('areaParkir')
        ->whereHas('areaParkir', function($q) use ($request) {
            $q->where('lokasi_parkir_id', $request->lokasi_parkir_id)
            ->where('jenis_kendaraan', $request->kendaraan);
        })
        ->get();

        return view('customers.denah', compact('lokasi', 'slotParkir', 'kendaraan', 'areas'))
            ->with([
                'tanggal'   => $request->tanggal_parkir,
                'jam_masuk' => $request->jam_masuk,
                'durasi'    => $request->durasi_jam,
                'jenis_kendaraan' => $request->kendaraan,
            ]);
    }
}