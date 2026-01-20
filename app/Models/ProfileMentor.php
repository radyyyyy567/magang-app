<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfileMentor extends Model
{
    protected $fillable = [
        'intern_id',
        'nomor_induk',
        'foto',
        'no_telp',
        'alamat',
        'instansi',
        'awal_magang',
        'akhir_magang',
    ];

    protected $casts = [
        'awal_magang' => 'date',
        'akhir_magang' => 'date',
    ];

    public function intern()
    {
        return $this->belongsTo(User::class, 'intern_id');
    }
}
