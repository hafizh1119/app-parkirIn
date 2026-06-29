<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    DB::statement("ALTER TABLE reservasi MODIFY COLUMN status ENUM('pending', 'dibayar', 'digunakan') NOT NULL DEFAULT 'pending'");
}



    /**
     * Reverse the migrations.
     */
    public function down()
{
    DB::statement("ALTER TABLE reservasi MODIFY COLUMN status ENUM('pending', 'dibayar') NOT NULL DEFAULT 'pending'");
}
};
