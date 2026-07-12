<?php

namespace App\Http\Controllers;

use App\Models\LokasiParkir;

class HomeController extends Controller
{
    public function index()
    {
        $lokasiParkir = LokasiParkir::with('areaParkir.slotParkir')->get();

        foreach ($lokasiParkir as $lokasi) {

            $semuaSlot = $lokasi->areaParkir->flatMap->slotParkir;

            $lokasi->slot_mobil = $semuaSlot
                ->filter(fn($slot) => $slot->areaParkir->jenis_kendaraan == 'mobil' && $slot->status == 'tersedia')
                ->count();

            $lokasi->slot_motor = $semuaSlot
                ->filter(fn($slot) => $slot->areaParkir->jenis_kendaraan == 'motor' && $slot->status == 'tersedia')
                ->count();

            $lokasi->tarif_per_jam = $lokasi->areaParkir->min('tarif_per_jam');
        }

        return view('dashboard', compact('lokasiParkir'));
    }
}