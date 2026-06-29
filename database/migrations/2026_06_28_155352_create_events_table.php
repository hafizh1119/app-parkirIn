<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->integer('discount_percentage')->default(0); // ✅ TAMBAHKAN INI
            $table->string('image')->nullable();
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->enum('status', ['upcoming', 'active', 'completed', 'waiting'])->default('upcoming');
            $table->integer('max_capacity')->nullable();
            $table->integer('current_participants')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Tabel pivot untuk event dan lokasi parkir (many-to-many)
        Schema::create('event_lokasi_parkir', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained('events')->onDelete('cascade');
            $table->foreignId('lokasi_parkir_id')->constrained('lokasi_parkir')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('event_lokasi_parkir');
        Schema::dropIfExists('events');
    }
};