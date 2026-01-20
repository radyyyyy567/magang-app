<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InternshipApplication extends Model
{
    protected $fillable = [
        'mentor_id',
        'intern_id',
        'title',
        'description',
        'activity_date',
    ];

    protected $casts = [
        'activity_date' => 'datetime',
    ];

    public function mentor()
    {
        return $this->belongsTo(User::class, 'mentor_id');
    }

    public function intern()
    {
        return $this->belongsTo(User::class, 'intern_id');
    }
}
