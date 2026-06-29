<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LokasiParkir;
use App\Models\Reservasi;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index(Request $request)
    {
        $lokasiId = $request->lokasi_id;
        $jenis    = $request->jenis;

        $query = Reservasi::query()
            ->with([
                'user:id,name',
                'kendaraan:id,nomor_polisi,jenis_kendaraan',
                'lokasiParkir:id,nama',
                'slotParkir:id,kode_slot'
            ])
            ->select([
                'id',
                'kode_reservasi',
                'user_id',
                'kendaraan_id',
                'lokasi_parkir_id',
                'slot_parkir_id',
                'jam_masuk_aktual',
                'jam_keluar_aktual',
                'total_bayar',
                'status',
                'created_at'
            ]);

        if ($lokasiId) {
            $query->where('lokasi_parkir_id', $lokasiId);
        }

        if ($jenis) {
            $query->whereHas('kendaraan', function ($q) use ($jenis) {
                $q->where('jenis_kendaraan', $jenis);
            });
        }

        $history = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $lokasi = LokasiParkir::select(
            'id',
            'nama'
        )->orderBy('nama')->get();

        $totalParkir = (clone $query)->count();

        $parkirMobil = (clone $query)
            ->whereHas('kendaraan', function ($q) {
                $q->where('jenis_kendaraan', 'Mobil');
            })
            ->count();

        $parkirMotor = (clone $query)
            ->whereHas('kendaraan', function ($q) {
                $q->where('jenis_kendaraan', 'Motor');
            })
            ->count();

        $pendapatan = (clone $query)
            ->whereIn('status', [
                'checkout',
                'digunakan'
            ])
            ->sum('total_bayar');

        return view(
            'Admin.history.index',
            compact(
                'history',
                'lokasi',
                'totalParkir',
                'parkirMobil',
                'parkirMotor',
                'pendapatan'
            )
        );
    }
}