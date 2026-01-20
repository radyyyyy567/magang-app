<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = [
        'intern_id',
        'position_id',
        'application_status',
    ];

    protected $casts = [
        'application_status' => 'string',
    ];

    public function intern()
    {
        return $this->belongsTo(User::class, 'intern_id');
    }

    public function position()
    {
        return $this->belongsTo(InternshipPosition::class, 'position_id');
    }
}
