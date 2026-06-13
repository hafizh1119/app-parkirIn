<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Reservasi;

class TiketParkirController extends Controller
{
    public function show(string $id)
    {
        $reservasi = Reservasi::with([
            'slotParkir',
            'lokasiParkir',
            'kendaraan',
            'tiketParkir'
        ])->findOrFail($id);

        return view(
            'customers.qr-muncul',
            compact('reservasi')
        );
    }
}