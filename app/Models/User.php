<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role', //
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function canAccessPanel(Panel $panel): bool
    {
        
        if ($panel->getId() === 'admin') {
            return $this->role === 'admin';
        }

        if ($panel->getId() === 'mentor') {
            return $this->role === 'mentor';
        }

        if ($panel->getId() === 'intern') {
            return $this->role === 'intern';
        }

        return false;
    }

    // Relationships
    public function mentorProfile()
    {
        return $this->hasOne(ProfileInternship::class, 'mentor_id');
    }

    public function internProfile()
    {
        return $this->hasOne(ProfileMentor::class, 'intern_id');
    }

    public function mentorActivities()
    {
        return $this->hasMany(Activity::class, 'mentor_id');
    }

    public function internAttendances()
    {
        return $this->hasMany(InternshipPosition::class, 'intern_id');
    }

    public function internApplications()
    {
        return $this->hasMany(InternshipApplication::class, 'intern_id');
    }
}
