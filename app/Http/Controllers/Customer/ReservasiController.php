<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Reservasi;
use App\Models\SlotParkir;
use Illuminate\Http\Request;

class ReservasiController extends Controller
{
    public function show(string $id)
    {
        $slot = SlotParkir::with('lokasiParkir')
            ->findOrFail($id);

        return view(
            'customers.reservasi',
            compact('slot')
        );
    }

    public function store(Request $request)
    {
        $reservasi = Reservasi::create([
            'kode_reservasi' => 'RSV-' . time(),
            'user_id' => auth()->id(),
            'kendaraan_id' => $request->kendaraan_id,
            'lokasi_parkir_id' => $request->lokasi_parkir_id,
            'slot_parkir_id' => $request->slot_parkir_id,
            'tanggal_masuk' => now()->toDateString(),
            'jam_masuk' => now()->format('H:i:s'),
            'durasi_jam' => 2,
            'total_bayar' => $request->total_bayar,
            'status' => 'pending'
        ]);

        return redirect()->route(
            'customer.pembayaran.show',
            $reservasi->id
        );
    }
}