<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AreaParkir extends Model
{
    protected $table = 'area_parkir';

    protected $fillable = [
        'lokasi_parkir_id',
        'nama_area',
        'jenis_kendaraan',
        'kapasitas',
        'tarif_per_jam',
        'status',
        'deskripsi'
    ];

    public function lokasiParkir()
    {
        return $this->belongsTo(LokasiParkir::class);
    }

    public function slotParkir()
    {
        return $this->hasMany(SlotParkir::class, 'area_parkir_id');
    }
}