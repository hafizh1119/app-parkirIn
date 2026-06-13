<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\LokasiParkir;
use App\Models\SlotParkir;
use Illuminate\Http\Request;
use App\Models\Kendaraan;

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

    public function aturJadwal($id)
    {
        $lokasi = LokasiParkir::findOrFail($id);

        return view(
            'customers.atur-jadwal',
            compact('lokasi')
        );
    }

    public function denah(Request $request)
    {
        $lokasi = LokasiParkir::findOrFail(
            $request->lokasi_parkir_id
        );

        $kendaraan = Kendaraan::where(
            'user_id',
            auth::id()
        )->first();

        $slotParkir = SlotParkir::where(
                'lokasi_parkir_id',
                $request->lokasi_parkir_id
            )
            ->where(
                'jenis_kendaraan',
                $request->kendaraan
            )
            ->get();

        return view(
            'customers.denah',
            compact(
                'lokasi',
                'slotParkir',
                'kendaraan'
            )
        );
    }
}