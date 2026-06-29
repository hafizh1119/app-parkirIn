<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // ============================================
        // 1. TABEL MEMBERSHIPS
        // ============================================
        Schema::create('memberships', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->enum('tier', ['basic', 'premium', 'gold'])->default('basic');
            $table->integer('total_points')->default(0);
            $table->integer('redeemed_points')->default(0);
            $table->integer('available_points')->default(0);
            $table->date('join_date')->nullable();
            $table->date('expiry_date')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index('user_id');
            $table->index('tier');
            $table->index('is_active');
        });

        // ============================================
        // 2. TABEL POINT TRANSACTIONS
        // ============================================
        Schema::create('point_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->unsignedBigInteger('transaction_id')->nullable();
            
            $table->integer('points');
            $table->enum('type', ['earn', 'redeem', 'bonus', 'expired'])->default('earn');
            $table->string('description')->nullable();
            $table->timestamps();

            $table->index('user_id');
            $table->index('type');
            $table->index('created_at');
        });

        // ============================================
        // 3. TABEL POINT SETTINGS
        // ============================================
        Schema::create('point_settings', function (Blueprint $table) {
            $table->id();
            $table->integer('points_per_rupiah')->default(10);
            $table->integer('min_transaction')->default(10000);
            $table->integer('redeem_points')->default(6000);
            $table->timestamps();
        });

        // ============================================
        // 4. TABEL MEMBERSHIP TIERS
        // ============================================
        Schema::create('membership_tiers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->integer('min_points')->default(0);
            $table->integer('max_points')->nullable();
            $table->integer('discount_percentage')->default(0);
            $table->float('point_multiplier')->default(1.0);
            $table->json('benefits')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index('slug');
            $table->index('is_active');
            $table->index(['min_points', 'max_points']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('membership_tiers');
        Schema::dropIfExists('point_settings');
        Schema::dropIfExists('point_transactions');
        Schema::dropIfExists('memberships');
    }
};