<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Membership;
use App\Models\PembayaranMembership;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Transaction;
use Carbon\Carbon;

class MembershipController extends Controller
{
    /**
     * Halaman Membership
     */
    public function index()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        // Jika sudah menjadi member
        if ($user->status_member === 'member') {
            return redirect()
                ->route('dashboard')
                ->with('success', 'Anda sudah menjadi Member ParkirIn.');
        }

        // Ambil / buat data membership
        $membership = Membership::firstOrCreate(
            [
                'user_id' => $user->id
            ],
            [
                'tier' => 'basic',
                'total_points' => 0,
                'redeemed_points' => 0,
                'available_points' => 0,
                'join_date' => null,
                'expiry_date' => null,
                'is_active' => false
            ]
        );

        // Harga paket (sementara)
        $membership->harga = 50000;

        // Ambil / buat pembayaran membership
        $pembayaran = PembayaranMembership::firstOrCreate(
            [
                'membership_id' => $membership->id
            ],
            [
                'user_id'      => $user->id,
                'order_id'     => 'MBR-' . time(),
                'gross_amount' => 50000,
                'status'       => 'belum_bayar'
            ]
        );

        // Konfigurasi Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');

        // Generate Snap Token jika belum ada
        if (!$pembayaran->snap_token) {

            $params = [

                'transaction_details' => [

                    'order_id' => $pembayaran->order_id,
                    'gross_amount' => (int) $pembayaran->gross_amount

                ],

                'customer_details' => [

                    'first_name' => $user->name,
                    'email'      => $user->email,
                    'phone'      => $user->nomor_hp

                ],

                'item_details' => [[

                    'id'       => $membership->id,
                    'price'    => (int) $pembayaran->gross_amount,
                    'quantity' => 1,
                    'name'     => 'Membership ParkirIn Lifetime'

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
            'customers.pembayaran-member',
            compact(
                'membership',
                'pembayaran',
                'statusPembayaran'
            )
        );
    }

    /**
     * Membuat pembayaran membership
     * (sementara, nanti disambungkan ke Midtrans)
     */
    public function payment(Request $request)
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');

        $user = Auth::user();

        $membership = Membership::where('user_id', $user->id)->firstOrFail();

        $pembayaran = PembayaranMembership::firstOrCreate(
            [
                'membership_id' => $membership->id
            ],
            [
                'user_id' => $user->id,
                'order_id' => 'MBR-' . time(),
                'gross_amount' => 50000,
                'status' => 'belum_bayar'
            ]
        );

        if (!$pembayaran->snap_token) {

            $params = [

                'transaction_details' => [

                    'order_id' => $pembayaran->order_id,

                    'gross_amount' => $pembayaran->gross_amount

                ],

                'customer_details' => [

                    'first_name' => $user->name,

                    'email' => $user->email,

                    'phone' => $user->nomor_hp

                ]

            ];

            $snapToken = Snap::getSnapToken($params);

            $pembayaran->update([
                'snap_token' => $snapToken
            ]);
        }

        return response()->json([
            'snap_token' => $pembayaran->snap_token
        ]);
    }

    /**
     * Finish pembayaran
     */
    public function finish(Request $request, $id)
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');

        $user = Auth::user();

        $membership = Membership::findOrFail($id);

        $pembayaran = PembayaranMembership::where(
            'membership_id',
            $membership->id
        )->firstOrFail();

        try {

            $response = Transaction::status($pembayaran->order_id);

            $status = json_decode(json_encode($response));

            if (in_array($status->transaction_status, ['settlement', 'capture'])) {

                $pembayaran->update([

                    'status' => 'dibayar',

                    'transaction_status' => $status->transaction_status,

                    'payment_type' => $status->payment_type ?? null,

                    'transaction_id' => $status->transaction_id ?? null,

                    'paid_at' => now()

                ]);

                $membership->update([

                    'tier' => 'basic',

                    'join_date' => Carbon::today(),

                    'expiry_date' => null,

                    'is_active' => true

                ]);

                $user->update([

                    'status_member' => 'member'

                ]);

                return response()->json([

                    'success' => true

                ]);
            }

            return response()->json([

                'success' => false,

                'message' => 'Pembayaran belum settlement.'

            ]);

        } catch (\Exception $e) {

            return response()->json([

                'success' => false,

                'message' => $e->getMessage()

            ],500);

        }
    }

    
}