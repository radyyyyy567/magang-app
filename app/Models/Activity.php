<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
        'division_id',
        'mentor_id',
        'title',
        'description',
        'quota',
        'status',
    ];

    protected $casts = [
        'status' => 'string',
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
