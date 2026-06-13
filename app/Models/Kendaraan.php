<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    protected $table = 'kendaraan';

    protected $fillable = [
        'user_id',
        'jenis_kendaraan',
        'nomor_polisi',
        'merk',
        'warna'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reservasi()
    {
        return $this->hasMany(Reservasi::class);
    }
}