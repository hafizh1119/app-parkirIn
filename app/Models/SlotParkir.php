<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SlotParkir extends Model
{
    protected $table = 'slot_parkir';

    protected $fillable = [
        'lokasi_parkir_id',
        'kode_slot',
        'area',
        'jenis_kendaraan',
        'status',
        'tarif_per_jam'
    ];

    public function lokasiParkir()
    {
        return $this->belongsTo(LokasiParkir::class);
    }

    public function reservasi()
    {
        return $this->hasMany(Reservasi::class);
    }
}