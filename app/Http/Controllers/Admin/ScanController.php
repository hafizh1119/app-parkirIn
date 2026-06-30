<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservasi;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ScanController extends Controller
{
    public function index()
    {
        return view('Admin.scan.index');
    }

    public function scan(Request $request)
    {
        $rawData = $request->qr_data;
        $data    = json_decode($rawData, true);

        $kodeReservasi = $data['kode_reservasi'] ?? $rawData;

        if (!$kodeReservasi) {
            return response()->json([
                'status'  => 'error',
                'message' => 'QR Code tidak valid'
            ]);
        }

        $reservasi = Reservasi::with([
            'slotParkir.areaParkir',
            'kendaraan',
            'user'
        ])
        ->where('kode_reservasi', $kodeReservasi)
        ->first();

        if (!$reservasi) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Reservasi tidak ditemukan'
            ]);
        }
        // Validasi check-in maksimal 15 menit sebelum jadwal
        if ($reservasi->status === 'dibayar') {

            $waktuReservasi = Carbon::parse(
                $reservasi->tanggal_masuk . ' ' . $reservasi->jam_masuk
            );

            $batasCheckin = $waktuReservasi->copy()->subMinutes(15);

            if (now()->lt($batasCheckin)) {

                return response()->json([
                    'status'  => 'error',
                    'message' => 'Check-in hanya dapat dilakukan 15 menit sebelum waktu reservasi'
                ]);
            }
        }

        // CHECK-IN
        if ($reservasi->status === 'dibayar') {
            $reservasi->update([
                'status' => 'checkin',
                'jam_masuk_aktual' => now(),
            ]);
            $reservasi->refresh();

            return response()->json([
                'status' => 'success',
                'mode'   => 'checkin',
                'message' => 'Check-in berhasil!',
                'reservasi' => [
                    'kode'      => $reservasi->kode_reservasi,
                    'nama'      => $reservasi->user->name ?? '-',
                    'slot'      => $reservasi->slotParkir->kode_slot ?? '-',
                    'kendaraan' => $reservasi->kendaraan->nomor_polisi ?? '-',
                    'tanggal'   => $reservasi->tanggal_masuk,
                    'jam'       => $reservasi->jam_masuk,
                    'durasi'    => $reservasi->durasi_jam,
                    'kekurangan' => 0,
                ]
            ]);
        }

        // CHECK-OUT
        if ($reservasi->status === 'checkin') {
            $jamMasuk     = Carbon::parse($reservasi->jam_masuk_aktual);
            $jamKeluar    = now();
            $durasiAktual = ceil($jamMasuk->diffInMinutes($jamKeluar) / 60);

            $tarifPerJam = $reservasi->slotParkir->tarif_per_jam;
            $totalDibayar = $reservasi->total_bayar;
            $totalAktual  = $durasiAktual * $tarifPerJam;
            $kekurangan   = max(0, $totalAktual - $totalDibayar);

            $reservasi->update([
                'status' => 'selesai',
                'jam_keluar_aktual' => $jamKeluar,
                'kekurangan_bayar' => $kekurangan,
            ]);
            $reservasi->refresh();

            return response()->json([
                'status'  => 'success',
                'mode'    => 'checkout',
                'message' => 'Check-out berhasil!',
                'reservasi' => [
                    'kode'          => $reservasi->kode_reservasi,
                    'nama'          => $reservasi->user->name ?? '-',
                    'slot'          => $reservasi->slotParkir->kode_slot ?? '-',
                    'kendaraan'     => $reservasi->kendaraan->nomor_polisi ?? '-',
                    'jam_masuk'     => $jamMasuk->format('H:i'),
                    'jam_keluar'    => $jamKeluar->format('H:i'),
                    'durasi_booking' => $reservasi->durasi_jam,
                    'durasi_aktual' => $durasiAktual,
                    'total_dibayar' => $totalDibayar,
                    'total_aktual'  => $totalAktual,
                    'kekurangan'    => $kekurangan,
                ]
            ]);
        }

        if ($reservasi->status === 'selesai') {
            return response()->json([
                'status'  => 'error',
                'message' => 'Kendaraan ini sudah selesai parkir'
            ]);
        }

        return response()->json([
            'status'  => 'error',
            'message' => 'Reservasi belum dibayar'
        ]);
    }
}