<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfileInternship extends Model
{
    protected $fillable = [
        'mentor_id',
        'nomor_induk',
        'foto',
        'no_telp',
        'alamat',
        'jabatan',
    ];

    public function mentor()
    {
        return $this->belongsTo(User::class, 'mentor_id');
    }
}
