<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LokasiParkirSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('lokasi_parkir')->insert([
            [
                'nama' => 'Parkir UDINUS',
                'alamat' => 'Jl. Imam Bonjol No.207, Pendrikan Kidul, Kec. Semarang Tengah, Kota Semarang, Jawa Tengah 50131',
                'link_maps' => 'https://maps.app.goo.gl/BVY6JsHcxLHPNiLo6',
                'gambar' => 'Udinus.jpg',
                'deskripsi' => 'Area parkir Universitas Dian Nuswantoro',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
