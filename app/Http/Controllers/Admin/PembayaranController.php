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
        $pembayaran = Pembayaran::with([
            'reservasi.user',
            'reservasi.lokasiParkir',
            'reservasi.slotParkir',
            'reservasi.kendaraan'
        ])->latest()->get();

        $totalPendapatan = Pembayaran::where('status', 'dibayar')
            ->with('reservasi')
            ->get()
            ->sum(fn ($item) => $item->reservasi->total_bayar ?? 0);

        $parkirMobil = Pembayaran::where('status', 'dibayar')
            ->whereHas('reservasi.kendaraan', function ($q) {
                $q->where('jenis_kendaraan', 'Mobil');
            })
            ->count();

        $parkirMotor = Pembayaran::where('status', 'dibayar')
            ->whereHas('reservasi.kendaraan', function ($q) {
                $q->where('jenis_kendaraan', 'Motor');
            })
            ->count();

        $totalTransaksi = Pembayaran::where('status', 'dibayar')
            ->count();

        return view(
            'Admin.pembayaran.index',
            compact(
                'pembayaran',
                'totalPendapatan',
                'parkirMobil',
                'parkirMotor',
                'totalTransaksi'
            )
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

    public function tolak($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->update(['status' => 'ditolak']);

        return back();
    }
}