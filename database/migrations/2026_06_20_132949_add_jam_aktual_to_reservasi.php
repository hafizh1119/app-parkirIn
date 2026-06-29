<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('reservasi', function (Blueprint $table) {
            $table->timestamp('jam_masuk_aktual')->nullable()->after('jam_masuk');
            $table->timestamp('jam_keluar_aktual')->nullable()->after('jam_masuk_aktual');
            $table->decimal('kekurangan_bayar', 10, 2)->default(0)->after('total_bayar');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservasi', function (Blueprint $table) {
            //
        });
    }
};
