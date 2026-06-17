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

        $pembayaran = Pembayaran::where(
            'reservasi_id',
            $reservasi->id
        )->latest()->first();

        $statusPembayaran = $pembayaran
            ? $pembayaran->status
            : 'belum_bayar';

        return view(
            'customers.pembayaran',
            compact(
                'reservasi',
                'pembayaran',
                'statusPembayaran'
            )
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'reservasi_id' => 'required',
            'bukti_pembayaran' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048'
        ]);

        $namaFile = time() . '.' .
            $request->file('bukti_pembayaran')->extension();

        $request->file('bukti_pembayaran')->move(
            public_path('assets/img/bukti-pembayaran'),
            $namaFile
        );

        Pembayaran::create([
            'reservasi_id' => $request->reservasi_id,
            'metode_pembayaran' => 'Transfer Bank',
            'bukti_pembayaran' => $namaFile,
            'tanggal_upload' => now(),
            'status' => 'menunggu_verifikasi'
        ]);

        return redirect()->route(
            'customer.pembayaran',
            $request->reservasi_id
        )->with(
            'success',
            'Bukti pembayaran berhasil dikirim'
        );
    }
}