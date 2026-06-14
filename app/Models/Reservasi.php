<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    protected $table = 'reservasi';

    protected $fillable = [
        'kode_reservasi',
        'qr_code',
        'user_id',
        'kendaraan_id',
        'lokasi_parkir_id',
        'slot_parkir_id',
        'tanggal_masuk',
        'jam_masuk',
        'durasi_jam',
        'total_bayar',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class);
    }

    public function lokasiParkir()
    {
        return $this->belongsTo(LokasiParkir::class);
    }

    public function slotParkir()
    {
        return $this->belongsTo(SlotParkir::class);
    }

    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class);
    }

    public function tiketParkir()
    {
        return $this->hasOne(TiketParkir::class);
    }
}