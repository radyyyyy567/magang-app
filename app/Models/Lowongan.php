<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lowongan extends Model
{
    protected $table = 'lowongans';
    protected $fillable = [
        'division_id',
        'mentor_id',
        'title',
        'description',
        'quota',
        'status',
        'monthly_data',
    ];

    protected $casts = [
        'status' => 'string',
        'monthly_data' => 'array',
    ];

    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    public function mentor()
    {
        return $this->belongsTo(User::class, 'mentor_id');
    }

    public function applications()
    {
        return $this->hasMany(Attendance::class, 'position_id');
    }
}
