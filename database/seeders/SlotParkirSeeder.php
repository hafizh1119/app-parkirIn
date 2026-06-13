<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SlotParkirSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 25; $i++) {

            DB::table('slot_parkir')->insert([
                'lokasi_parkir_id' => 1,
                'kode_slot' => 'A-' . $i,
                'area' => 'A',
                'jenis_kendaraan' => 'mobil',
                'status' => 'tersedia',
                'tarif_per_jam' => 5000,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        for ($i = 1; $i <= 25; $i++) {

            DB::table('slot_parkir')->insert([
                'lokasi_parkir_id' => 1,
                'kode_slot' => 'B-' . $i,
                'area' => 'B',
                'jenis_kendaraan' => 'mobil',
                'status' => 'tersedia',
                'tarif_per_jam' => 5000,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        for ($i = 1; $i <= 50; $i++) {

            DB::table('slot_parkir')->insert([
                'lokasi_parkir_id' => 1,
                'kode_slot' => 'C-' . $i,
                'area' => 'C',
                'jenis_kendaraan' => 'motor',
                'status' => 'tersedia',
                'tarif_per_jam' => 2000,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
