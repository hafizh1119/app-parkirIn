<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class SlotParkir extends Model
{
    protected $table = 'slot_parkir';

    protected $fillable = [
        'lokasi_parkir_id',
        'area_parkir_id',
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

    public function areaParkir()
    {
        return $this->belongsTo(AreaParkir::class);
    }

    public function getStatusTampilAttribute()
    {
        $now = now();

        $reservasi = $this->reservasi()
            ->whereIn('status', ['dibayar', 'checkin'])
            ->get()
            ->first(function ($reservasi) use ($now) {

                $mulai = Carbon::parse(
                    $reservasi->tanggal_masuk . ' ' . $reservasi->jam_masuk
                );

                return $now->greaterThanOrEqualTo($mulai)
                    && is_null($reservasi->jam_keluar_aktual);
            });

        return $reservasi ? 'terisi' : 'tersedia';
    }
}