<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentTest extends Model
{
    protected $fillable = [
        'user_id',
        'jenjang',
        'score',
        'status',
        'answers',
        'completed_at',
    ];

    protected $casts = [
        'answers' => 'array',
        'completed_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
