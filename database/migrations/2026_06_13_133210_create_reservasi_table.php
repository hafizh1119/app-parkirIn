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
        Schema::create('reservasi', function (Blueprint $table) {
            $table->id();

            $table->string('kode_reservasi', 50)->unique();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('kendaraan_id')
                ->constrained('kendaraan')
                ->cascadeOnDelete();

            $table->foreignId('lokasi_parkir_id')
                ->constrained('lokasi_parkir')
                ->cascadeOnDelete();

            $table->foreignId('slot_parkir_id')
                ->constrained('slot_parkir')
                ->cascadeOnDelete();

            $table->date('tanggal_masuk');

            $table->time('jam_masuk');

            $table->integer('durasi_jam');

            $table->decimal('total_bayar', 10, 2);

            $table->enum('status', [
                'pending',
                'dibayar',
                'selesai',
                'dibatalkan'
            ])->default('pending');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservasi');
    }
};
