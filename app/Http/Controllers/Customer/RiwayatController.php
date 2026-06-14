<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Reservasi;
use Illuminate\Support\Facades\Auth;

class RiwayatController extends Controller
{
    public function index()
    {
        $riwayat = Reservasi::with([
            'lokasiParkir',
            'slotParkir',
            'kendaraan'
        ])
        ->where('user_id', Auth::id())
        ->latest()
        ->get();

        return view(
            'customers.riwayat',
            compact('riwayat')
        );
    }
}