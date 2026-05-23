<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentDocument extends Model
{
    protected $fillable = [
        'user_id',
        'ijazah',
        'transkrip_nilai',
        'akta_kelahiran',
        'kartu_keluarga',
        'nisn',
        'ktp_ortu',
        'sertifikat_prestasi',
        'sertifikat_tahfidz',
        'pas_foto',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
