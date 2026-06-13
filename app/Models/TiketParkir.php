<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TiketParkir extends Model
{
    protected $table = 'tiket_parkir';

    protected $fillable = [
        'reservasi_id',
        'kode_qr',
        'expired_at'
    ];

    public function reservasi()
    {
        return $this->belongsTo(Reservasi::class);
    }
}