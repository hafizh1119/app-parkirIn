<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\LokasiParkir;

class LokasiParkirController extends Controller
{
    public function index()
    {
        $lokasiParkir = LokasiParkir::with('slotParkir')->get();

        return view(
            'customers.cari-parkir',
            compact('lokasiParkir')
        );
    }

    public function show(string $id)
    {
        $lokasi = LokasiParkir::findOrFail($id);

        return view(
            'customers.denah',
            compact('lokasi')
        );
    }
}