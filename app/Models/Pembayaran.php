<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = 'pembayaran';

    protected $fillable = [
        'reservasi_id',
        'metode_pembayaran',
        'bukti_pembayaran',
        'tanggal_upload',
        'status',
        'verified_by',
        'verified_at'
    ];

    public function reservasi()
    {
        return $this->belongsTo(Reservasi::class);
    }
}