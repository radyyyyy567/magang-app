<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InternshipPosition extends Model
{
    protected $fillable = [
        'intern_id',
        'date',
        'check_in_time',
        'check_out_time',
        'status',
    ];

    protected $casts = [
        'date' => 'datetime',
        'check_in_time' => 'datetime',
        'check_out_time' => 'datetime',
        'status' => 'string',
    ];

    public function intern()
    {
        return $this->belongsTo(User::class, 'intern_id');
    }
}
