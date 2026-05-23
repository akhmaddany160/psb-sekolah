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
        Schema::table('student_details', function (Blueprint $table) {
            // Field tambahan data siswa
            $table->string('no_wa')->nullable()->after('asal_sekolah');

            // Field data orang tua
            $table->string('nama_ayah')->nullable()->after('no_wa');
            $table->string('nama_ibu')->nullable()->after('nama_ayah');
            $table->date('tanggal_lahir_ayah')->nullable()->after('nama_ibu');
            $table->date('tanggal_lahir_ibu')->nullable()->after('tanggal_lahir_ayah');
            $table->text('alamat_ortu')->nullable()->after('tanggal_lahir_ibu');
            $table->string('no_wa_ortu')->nullable()->after('alamat_ortu');
            $table->string('pekerjaan_ayah')->nullable()->after('no_wa_ortu');
            $table->string('pekerjaan_ibu')->nullable()->after('pekerjaan_ayah');

            // Field data wali (opsional)
            $table->string('nama_wali')->nullable()->after('pekerjaan_ibu');
            $table->string('no_wa_wali')->nullable()->after('nama_wali');
            $table->string('pekerjaan_wali')->nullable()->after('no_wa_wali');
            $table->text('alamat_wali')->nullable()->after('pekerjaan_wali');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('student_details', function (Blueprint $table) {
            $table->dropColumn([
                'no_wa',
                'nama_ayah',
                'nama_ibu',
                'tanggal_lahir_ayah',
                'tanggal_lahir_ibu',
                'alamat_ortu',
                'no_wa_ortu',
                'pekerjaan_ayah',
                'pekerjaan_ibu',
                'nama_wali',
                'no_wa_wali',
                'pekerjaan_wali',
                'alamat_wali',
            ]);
        });
    }
};
