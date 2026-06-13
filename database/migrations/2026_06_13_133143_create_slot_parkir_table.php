<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('slot_parkir', function (Blueprint $table) {
            $table->id();

            $table->foreignId('lokasi_parkir_id')
                ->constrained('lokasi_parkir')
                ->cascadeOnDelete();

            $table->string('kode_slot', 20);

            $table->string('area', 10);

            $table->enum('jenis_kendaraan', [
                'mobil',
                'motor'
            ]);

            $table->enum('status', [
                'tersedia',
                'terisi'
            ])->default('tersedia');

            $table->decimal('tarif_per_jam', 10, 2);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('slot_parkir');
    }
};
