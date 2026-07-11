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
        Schema::table('reservasi', function (Blueprint $table) {

            // Jumlah point yang digunakan
            $table->unsignedInteger('point_used')
                ->default(0)
                ->after('discount_amount');

            // Nominal potongan dari point
            $table->decimal('point_discount', 10, 2)
                ->default(0)
                ->after('point_used');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservasi', function (Blueprint $table) {

            $table->dropColumn([
                'point_used',
                'point_discount'
            ]);

        });
    }
};