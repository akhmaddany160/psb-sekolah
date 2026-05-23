<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentDetail extends Model
{
    protected $fillable = [
        'user_id',
        'nama_lengkap',
        'nisn',
        'nik',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'asal_sekolah',
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
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}