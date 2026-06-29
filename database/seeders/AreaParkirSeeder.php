<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AreaParkir;
use App\Models\LokasiParkir;

class AreaParkirSeeder extends Seeder
{
    public function run(): void
    {
        $dpMall = LokasiParkir::where('nama', 'DP MALL')->first();

        if (!$dpMall) {
            return;
        }

        AreaParkir::create([
            'lokasi_parkir_id' => $dpMall->id,
            'nama_area' => 'Area A',
            'jenis_kendaraan' => 'mobil',
            'kapasitas' => 20,
            'tarif_per_jam' => 5000,
            'status' => 'aktif',
            'deskripsi' => 'Area mobil dekat pintu masuk',
        ]);

        AreaParkir::create([
            'lokasi_parkir_id' => $dpMall->id,
            'nama_area' => 'Area B',
            'jenis_kendaraan' => 'mobil',
            'kapasitas' => 20,
            'tarif_per_jam' => 5000,
            'status' => 'aktif',
            'deskripsi' => 'Area mobil bagian tengah',
        ]);

        AreaParkir::create([
            'lokasi_parkir_id' => $dpMall->id,
            'nama_area' => 'Area C',
            'jenis_kendaraan' => 'mobil',
            'kapasitas' => 20,
            'tarif_per_jam' => 5000,
            'status' => 'aktif',
            'deskripsi' => 'Area mobil bagian belakang',
        ]);

        AreaParkir::create([
            'lokasi_parkir_id' => $dpMall->id,
            'nama_area' => 'Area D',
            'jenis_kendaraan' => 'motor',
            'kapasitas' => 50,
            'tarif_per_jam' => 2000,
            'status' => 'aktif',
            'deskripsi' => 'Area khusus motor',
        ]);
    }
}