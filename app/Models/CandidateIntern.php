<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CandidateIntern extends Model
{
    protected $fillable = [
        'user_id',
        'lowongan_id',
        'name',
        'nik',
        'transcript_path',
        'cv_path',
        'photo_path',
        'description',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lowongan()
    {
        return $this->belongsTo(Lowongan::class);
    }
}
