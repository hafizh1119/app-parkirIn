<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use App\Models\Reservasi;
use App\Models\SlotParkir;
use Illuminate\Support\Facades\Auth;

class PembayaranController extends Controller
{
    public function index()
    {
        $pembayaran = Pembayaran::latest()->get();

        return view(
            'admin.kelola-pembayaran',
            compact('pembayaran')
        );
    }

    public function verifikasi($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);

        $pembayaran->update([
            'status' => 'dibayar',
            'verified_by' => Auth::id(),
            'verified_at' => now()
        ]);

        $reservasi = Reservasi::findOrFail(
            $pembayaran->reservasi_id
        );

        $reservasi->update([
            'status' => 'dibayar'
        ]);

        SlotParkir::find($reservasi->slot_parkir_id)
            ->update([
                'status' => 'terisi'
            ]);

        return back();
    }
}