<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LokasiParkir extends Model
{
    use HasFactory;

    protected $table = 'lokasi_parkir';

    protected $fillable = [
        'nama',
        'alamat',
        'link_maps',
        'gambar',
        'deskripsi'
    ];

    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_lokasi_parkir');
    }

    public function areaParkir()
    {
        return $this->hasMany(AreaParkir::class, 'lokasi_parkir_id'); 
    }

    public function reservasi()
    {
        return $this->hasMany(Reservasi::class, 'lokasi_parkir_id'); 
    }

    public function getNamaLengkapAttribute()
    {
        return $this->nama . ' - ' . $this->alamat;
    }
}