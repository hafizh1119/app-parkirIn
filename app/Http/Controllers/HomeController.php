<?php

namespace App\Http\Controllers;

use App\Models\LokasiParkir;

class HomeController extends Controller
{
    public function index()
    {
        $lokasiParkir = LokasiParkir::with('areaParkir.slotParkir')->get();

        foreach ($lokasiParkir as $parkir) {
            $semuaSlot = $parkir->areaParkir->flatMap->slotParkir;

            $parkir->slot_mobil    = $semuaSlot->where('jenis_kendaraan', 'mobil')->where('status', 'tersedia')->count();
            $parkir->slot_motor    = $semuaSlot->where('jenis_kendaraan', 'motor')->where('status', 'tersedia')->count();
            $parkir->tarif_per_jam = $parkir->areaParkir->min('tarif_per_jam') ?? 0;
        }

        return view('dashboard', compact('lokasiParkir'));
    }
}