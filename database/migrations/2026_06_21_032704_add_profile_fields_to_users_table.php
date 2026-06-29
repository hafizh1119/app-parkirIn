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
        Schema::table('users', function (Blueprint $table) {

            $table->string('nomor_hp', 20)
                ->nullable()
                ->after('email');

            $table->enum('status_member', [
                'member',
                'biasa'
            ])->default('biasa');

            $table->enum('status_akun', [
                'aktif',
                'nonaktif'
            ])->default('aktif');

            $table->string('foto_profil')
                ->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
