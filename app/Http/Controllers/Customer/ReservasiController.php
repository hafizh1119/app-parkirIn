<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Reservasi;
use App\Models\SlotParkir;
use App\Models\Kendaraan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;

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

        $namaQr = $reservasi->kode_reservasi . '.png';

        $namaQr = $reservasi->kode_reservasi . '.png';

        $dataQr = json_encode([
            'kode_reservasi' => $reservasi->kode_reservasi,
            'slot' => $reservasi->slot_parkir_id,
            'tanggal' => $reservasi->tanggal_masuk,
            'jam' => $reservasi->jam_masuk
        ]);

        $result = Builder::create()
            ->writer(new PngWriter())
            ->data($dataQr)
            ->size(500)
            ->margin(10)
            ->build();

        $result->saveToFile(
            public_path('assets/img/qrcode/' . $namaQr)
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

    public function downloadTicket(Reservasi $reservasi)
    {
        $canvas = imagecreatetruecolor(600, 900);

        $white = imagecolorallocate($canvas, 255, 255, 255);
        $black = imagecolorallocate($canvas, 0, 0, 0);
        $blue  = imagecolorallocate($canvas, 79, 70, 229);

        imagefill($canvas, 0, 0, $white);

        imagestring($canvas, 5, 240, 30, 'PARKIRIN', $blue);
    
        $qrPath = public_path('assets/img/qrcode/' . $reservasi->qr_code);
        $qr = imagecreatefrompng($qrPath);

        imagecopyresampled(
            $canvas,
            $qr,
            100,
            80,
            0,
            0,
            400,
            400,
            imagesx($qr),
            imagesy($qr)
        );

      // Judul Detail Reservasi
imagestring($canvas, 5, 190, 540, 'DETAIL RESERVASI', $black);

// Baris 1
imagestring($canvas, 4, 140, 600, 'Lokasi', $black);
imagestring($canvas, 4, 350, 600, 'Slot', $black);

imagestring(
    $canvas,
    4,
    140,
    625,
    $reservasi->lokasiParkir->nama,
    $blue
);

imagestring(
    $canvas,
    4,
    350,
    625,
    $reservasi->slotParkir->kode_slot,
    $blue
);

// Baris 2
imagestring($canvas, 4, 140, 700, 'Tanggal', $black);
imagestring($canvas, 4, 350, 700, 'Jam Masuk', $black);

imagestring(
    $canvas,
    4,
    140,
    725,
    date('d M Y', strtotime($reservasi->tanggal_masuk)),
    $blue
);

imagestring(
    $canvas,
    4,
    350,
    725,
    substr($reservasi->jam_masuk, 0, 5) . ' WIB',
    $blue
);

        ob_start();
        imagejpeg($canvas, null, 100);
        $imageData = ob_get_clean();

        imagedestroy($canvas);
        imagedestroy($qr);

        return response($imageData)
            ->header('Content-Type', 'image/jpeg')
            ->header(
                'Content-Disposition',
                'attachment; filename=tiket-' . $reservasi->kode_reservasi . '.jpg'
            );
    }
}