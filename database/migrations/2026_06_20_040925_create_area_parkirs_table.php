<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('area_parkir', function (Blueprint $table) {

            $table->id();

            $table->foreignId('lokasi_parkir_id')
                ->constrained('lokasi_parkir')
                ->cascadeOnDelete();

            $table->string('nama_area'); // Area A, Area B, Area C

            $table->enum('jenis_kendaraan', [
                'mobil',
                'motor'
            ]);

            $table->integer('kapasitas');

            $table->decimal('tarif_per_jam', 10, 2);

            $table->enum('status', [
                'aktif',
                'nonaktif'
            ])->default('aktif');

            $table->text('deskripsi')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('area_parkir');
    }
};