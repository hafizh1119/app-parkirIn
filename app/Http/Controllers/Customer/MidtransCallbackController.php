<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use App\Models\Reservasi;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Notification;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Facades\Log;

class MidtransCallbackController extends Controller
{
    public function handle(Request $request)
    {
        Log::info('CALLBACK MIDTRANS MASUK');
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');

        $notification = new Notification();

        $orderId = $notification->order_id;
        $transactionStatus = $notification->transaction_status;
        $paymentType = $notification->payment_type;
        $transactionId = $notification->transaction_id;

        $pembayaran = Pembayaran::where(
            'order_id',
            $orderId
        )->first();

        if (!$pembayaran) {
            return response()->json([
                'message' => 'Pembayaran tidak ditemukan'
            ], 404);
        }

        $pembayaran->update([
            'status' => 'dibayar',
            'paid_at' => now(),
        ]);

        if (
            $transactionStatus == 'settlement' ||
            $transactionStatus == 'capture'
        ) {

            $pembayaran->update([
                'status' => 'dibayar',
                'paid_at' => now()
            ]);

            $reservasi = Reservasi::find($pembayaran->reservasi_id);
            $reservasi->update([
                'status' => 'dibayar'
            ]);

        } elseif (
            in_array($transactionStatus, [
                'expire',
                'cancel',
                'deny'
            ])
        ) {

            $pembayaran->update([
                'status' => 'gagal'
            ]);

            Reservasi::where(
                'id',
                $pembayaran->reservasi_id
            )->update([
                'status' => 'batal'
            ]);
        }

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

        return response()->json([
            'message' => 'OK'
        ]);

        
    }
}