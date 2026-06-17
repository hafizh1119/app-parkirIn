<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KendaraanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kendaraan')->insert([
            [
                'user_id' => 2,
                'jenis_kendaraan' => 'mobil',
                'nomor_polisi' => 'H 4567 WE',
                'merk' => 'Toyota Avanza',
                'warna' => 'Putih',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
