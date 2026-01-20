<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ScheduleAttendance extends Model
{
    protected $fillable = [
        'day_of_week',
        'start_time',
        'end_time',
        'status',
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'status' => 'string',
    ];
}
