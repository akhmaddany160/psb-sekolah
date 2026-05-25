<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\StudentDetail;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Buat Akun User Utama (Akhmad Dany Fathurra)
        $user = User::updateOrCreate(
            ['email' => 'ahkmaddany1@gmail.com'],
            [
                'id' => 1,
                'name' => 'Akhmad Dany Fathurra',
                'phone_number' => '6285880037794',
                'jenjang' => 'SMA',
                // Password di bawah adalah hash asli dari akun Anda yang aktif
                'password' => '$2y$12$XykgCxl55ENJg.Oh.9zNKu.Te0NGjZZeN/K5U92MLpP2aJyMF4JOa',
            ]
        );

        // 2. Buat Detail Biodata Siswa yang Sama Persis dengan Milik Anda
        StudentDetail::updateOrCreate(
            ['user_id' => $user->id],
            [
                'nama_lengkap' => 'Akhmad Dany Fathurrasyad',
                'nisn' => null,
                'nik' => null,
                'tempat_lahir' => 'Ponorogo',
                'tanggal_lahir' => '2002-07-16',
                'jenis_kelamin' => 'L',
                'alamat' => 'Telaga Harapan Blok K11 No.11, Ds. Telaga Murni, Kec. Cikarang Barat, Kab. Bekasi',
                'asal_sekolah' => 'Universitas Muhammadiyah Prof. Dr. Hamka',
                'no_wa' => '+6285880037794',
                
                // Orang Tua
                'nama_ayah' => 'Ari Widyantoro',
                'nama_ibu' => 'Siti Nurchayatin',
                'tanggal_lahir_ayah' => '1972-07-25',
                'tanggal_lahir_ibu' => '1978-05-07',
                'alamat_ortu' => 'Telaga Harapan Blok K11 No.11, Ds. Telaga Murni, Kec. Cikarang Barat, Kab. Bekasi',
                'no_wa_ortu' => '+6281216439607',
                'pekerjaan_ayah' => '-',
                'pekerjaan_ibu' => 'Karyawan Swasta',
                
                // Wali
                'nama_wali' => null,
                'no_wa_wali' => null,
                'pekerjaan_wali' => null,
                'alamat_wali' => null,
            ]
        );
    }
}
