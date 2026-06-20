<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('slot_parkir', function (Blueprint $table) {

            $table->dropForeign(['lokasi_parkir_id']);

            $table->dropColumn([
                'lokasi_parkir_id',
                'area',
                'jenis_kendaraan',
                'tarif_per_jam'
            ]);
        });
    }

    public function down(): void
    {
        Schema::table('slot_parkir', function (Blueprint $table) {

            $table->dropForeign(['area_parkir_id']);
            $table->dropColumn('area_parkir_id');

            $table->unsignedBigInteger('lokasi_parkir_id');
            $table->string('area');
            $table->string('jenis_kendaraan');
            $table->decimal('tarif_per_jam', 10, 2);

            $table->foreign('lokasi_parkir_id')
                ->references('id')
                ->on('lokasi_parkir')
                ->cascadeOnDelete();
        });
    }
};