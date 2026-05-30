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
            $table->enum('pembayaran_formulir', ['BELUM_BAYAR', 'LUNAS'])->default('BELUM_BAYAR')->after('jenjang');
            $table->enum('pembayaran_daftar_ulang', ['BELUM_BAYAR', 'LUNAS'])->default('BELUM_BAYAR')->after('pembayaran_formulir');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['pembayaran_formulir', 'pembayaran_daftar_ulang']);
        });
    }
};
