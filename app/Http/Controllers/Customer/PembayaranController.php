<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use App\Models\Reservasi;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function show(string $id)
    {
        $reservasi = Reservasi::with([
            'slotParkir',
            'lokasiParkir',
            'kendaraan'
        ])->findOrFail($id);

        return view(
            'customers.pembayaran',
            compact('reservasi')
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'reservasi_id' => 'required',
            'bukti_pembayaran' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048'
        ]);

        $file = $request
            ->file('bukti_pembayaran')
            ->store('bukti-pembayaran', 'public');

        Pembayaran::create([
            'reservasi_id' => $request->reservasi_id,
            'metode_pembayaran' => 'Transfer Bank',
            'bukti_pembayaran' => $file,
            'tanggal_upload' => now(),
            'status' => 'menunggu_verifikasi'
        ]);

        return back()->with(
            'success',
            'Bukti pembayaran berhasil dikirim'
        );
    }
}