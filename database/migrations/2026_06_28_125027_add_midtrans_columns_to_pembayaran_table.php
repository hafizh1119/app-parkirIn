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
        Schema::table('pembayaran', function (Blueprint $table) {

            $table->string('order_id')->nullable()->after('reservasi_id');

            $table->string('snap_token')->nullable()->after('order_id');

            $table->string('transaction_id')->nullable()->after('snap_token');

            $table->decimal('gross_amount', 10, 2)->nullable()->after('transaction_id');

            $table->string('payment_type')->nullable()->after('gross_amount');

            $table->string('transaction_status')->nullable()->after('payment_type');

            $table->timestamp('paid_at')->nullable()->after('transaction_status');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pembayaran', function (Blueprint $table) {

            $table->dropColumn([
                'order_id',
                'snap_token',
                'transaction_id',
                'gross_amount',
                'payment_type',
                'transaction_status',
                'paid_at'
            ]);

        });
    }
};
