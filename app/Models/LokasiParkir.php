<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LokasiParkir extends Model
{
    protected $table = 'lokasi_parkir';

    protected $fillable = [
        'nama',
        'alamat',
        'link_maps',
        'gambar',
        'deskripsi'
    ];

    public function lokasiParkir()
    {
        return $this->belongsTo(LokasiParkir::class);
    }

    public function reservasi()
    {
        return $this->hasMany(Reservasi::class);
    }

    public function areaParkir()
    {
        return $this->hasMany(AreaParkir::class);
    }
}