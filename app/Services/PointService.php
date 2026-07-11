<?php

namespace App\Services;

use App\Models\PointSetting;
use App\Models\PointTransaction;
use App\Models\Reservasi;

class PointService
{
    public static function givePoint(Reservasi $reservasi)
    {
        // Ambil user
        $user = $reservasi->user;

        // Hanya member yang mendapat point
        if (!$user || $user->status_member !== 'member') {
            return false;
        }

        // Cek apakah reservasi ini sudah pernah mendapat point
        $already = PointTransaction::where('reservasi_id', $reservasi->id)->exists();

        if ($already) {
            return false;
        }

        // Ambil pengaturan point
        $setting = PointSetting::first();

        if (!$setting) {
            return false;
        }

        $totalBayar = $reservasi->total_bayar;

        // Cek minimal transaksi
        if ($totalBayar < $setting->min_transaction) {
            return false;
        }

        // Hitung point
        $point = floor(
            $totalBayar / $setting->min_transaction
        ) * $setting->points_per_rupiah;

        if ($point <= 0) {
            return false;
        }

        // Simpan riwayat point
        PointTransaction::create([
            'user_id'       => $user->id,
            'reservasi_id'  => $reservasi->id,
            'points'        => $point,
            'type'          => 'earn',
            'description'   => 'Point dari transaksi parkir ' . $reservasi->kode_reservasi,
        ]);

        $user->increment('total_points', $point);

        return true;
    }
}