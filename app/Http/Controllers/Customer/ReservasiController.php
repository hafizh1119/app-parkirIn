<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Reservasi;
use App\Models\SlotParkir;
use App\Models\Kendaraan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ReservasiController extends Controller
{
    public function show(Request $request, string $id)
    {
        $slot = SlotParkir::with('areaParkir.lokasiParkir')
            ->findOrFail($id);

        $lokasi    = $slot->areaParkir->lokasiParkir;
        $kendaraan = Kendaraan::where('user_id', Auth::id())->first();
        $tanggal   = $request->tanggal_parkir;
        $jam_masuk = $request->jam_masuk;
        $durasi    = $request->durasi_jam;

        return view('customers.reservasi', compact('lokasi', 'slot', 'kendaraan', 'tanggal', 'jam_masuk', 'durasi'));
    }

    public function store(Request $request)
    {
        // Cek apakah slot sudah direservasi pending
        $existing = Reservasi::where('slot_parkir_id', $request->slot_parkir_id)
            ->whereIn('status', ['pending', 'dibayar'])
            ->exists();

        if ($existing) {
            return back()->with('error', 'Slot sudah direservasi');
        }

        $kendaraan = Kendaraan::where('user_id', Auth::id())->first();

        $kodeReservasi =
            'RSV-' .
            strtoupper(
                substr(md5(uniqid()), 0, 8)
            );

        $reservasi = Reservasi::create([
            'kode_reservasi' => $kodeReservasi,
            'user_id' => Auth::id(),
            'kendaraan_id' => $kendaraan->id,
            'lokasi_parkir_id' => $request->lokasi_parkir_id,
            'slot_parkir_id' => $request->slot_parkir_id,
            'tanggal_masuk' => $request->tanggal_masuk,
            'jam_masuk' => $request->jam_masuk,
            'durasi_jam' => $request->durasi_jam,
            'total_bayar' => $request->total_bayar,
            'status' => 'pending'
        ]);

        $namaQr = $reservasi->kode_reservasi . '.svg';

        $dataQr = json_encode([
            'kode_reservasi' => $reservasi->kode_reservasi,
            'slot' => $reservasi->slot_parkir_id,
            'tanggal' => $reservasi->tanggal_masuk,
            'jam' => $reservasi->jam_masuk
        ]);

        $qrCode = QrCode::format('svg')
            ->size(300)
            ->generate($dataQr);

        file_put_contents(
            public_path('assets/img/qrcode/' . $namaQr),
            $qrCode
        );
        
        $reservasi->update([
            'qr_code' => $namaQr
        ]);

        return redirect()->route(
            'customer.pembayaran',
            $reservasi->id
        );
    }

    public function tiket($id)
    {
        $reservasi = Reservasi::with([
            'slotParkir',
            'lokasiParkir',
            'kendaraan'
        ])->findOrFail($id);

        return view(
            'customers.qr-muncul',
            compact('reservasi')
        );
    }
}