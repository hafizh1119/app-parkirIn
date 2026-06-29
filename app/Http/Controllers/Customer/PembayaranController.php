<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use App\Models\Reservasi;
use Midtrans\Config;
use Midtrans\Snap;
use Illuminate\Support\Facades\Auth;
use Midtrans\Transaction;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;

class PembayaranController extends Controller
{
    public function show(string $id)
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');

        $reservasi = Reservasi::with([
            'slotParkir',
            'lokasiParkir',
            'kendaraan'
        ])->findOrFail($id);

        $pembayaran = Pembayaran::where(
            'reservasi_id',
            $reservasi->id
        )->firstOrFail();

        if (!$pembayaran->snap_token) {

            $params = [

                'transaction_details' => [

                    'order_id' => $pembayaran->order_id,
                    'gross_amount' => (int) $reservasi->total_bayar

                ],

                'customer_details' => [

                    'first_name' => Auth::user()->name,
                    'email' => Auth::user()->email,
                    'phone' => Auth::user()->nomor_hp

                ],

                'item_details' => [[

                    'id' => $reservasi->slotParkir->id,
                    'price' => (int) $reservasi->total_bayar,
                    'quantity' => 1,
                    'name' => 'Reservasi Parkir - '.$reservasi->slotParkir->kode_slot

                ]]

            ];

            $snapToken = Snap::getSnapToken($params);

            $pembayaran->update([
                'snap_token' => $snapToken
            ]);

            $pembayaran->refresh();

        }

        $statusPembayaran = $pembayaran->status;

        return view(
            'customers.pembayaran',
            compact(
                'reservasi',
                'pembayaran',
                'statusPembayaran'
            )
        );
    }

    public function getSnapToken(Reservasi $reservasi)
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');

        $orderId = 'PARKIRIN-' .
            $reservasi->kode_reservasi .
            '-' .
            time();

        $pembayaran = Pembayaran::firstOrCreate(
            [
                'reservasi_id' => $reservasi->id
            ],
            [
                'order_id' => $orderId,
                'gross_amount' => $reservasi->total_bayar,
                'status' => 'belum_bayar'
            ]
        );

        if (!$pembayaran->order_id) {

            $pembayaran->update([
                'order_id' => $orderId,
                'gross_amount' => $reservasi->total_bayar
            ]);

        }

        $params = [

            'transaction_details' => [

                'order_id' => $pembayaran->order_id,

                'gross_amount' => $reservasi->total_bayar

            ],

            'customer_details' => [

                'first_name' => Auth::user()->name,

                'email' => Auth::user()->email,

                'phone' => Auth::user()->nomor_hp

            ]

        ];

        $snapToken = Snap::getSnapToken($params);

        $pembayaran->update([
            'snap_token' => $snapToken
        ]);

        return response()->json([
            'snap_token' => $snapToken
        ]);
}

    public function finish($id)
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');

        $reservasi = Reservasi::with([
            'pembayaran',
            'slotParkir',
            'lokasiParkir'
        ])->findOrFail($id);

        $pembayaran = $reservasi->pembayaran;

        try {

            $response = Transaction::status($pembayaran->order_id);
            $status = json_decode(json_encode($response));

            if (in_array($status->transaction_status, ['settlement', 'capture'])) {

                // Update pembayaran
                $pembayaran->update([
                    'status' => 'dibayar',
                    'transaction_status' => $status->transaction_status,
                    'payment_type' => $status->payment_type ?? null,
                    'transaction_id' => $status->transaction_id ?? null,
                    'paid_at' => now()
                ]);

                // Update reservasi
                $reservasi->update([
                    'status' => 'dibayar'
                ]);

                // Generate QR jika belum ada
                if (!$reservasi->qr_code) {

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
                }

                return response()->json([
                    'success' => true
                ]);
            }

            return response()->json([
                'success' => false
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);

        }
    }
}