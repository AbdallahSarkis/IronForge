<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'role', 'google_id', 'avatar', 'gender', 'date_of_birth', 'location_address', 'location_latitude', 'location_longitude', 'coach_gym_locations', 'gym_name', 'gym_open_time', 'gym_close_time'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'date_of_birth' => 'date',
            'location_latitude' => 'float',
            'location_longitude' => 'float',
            'coach_gym_locations' => 'array',
            'gym_open_time' => 'string',
            'gym_close_time' => 'string',
            'password' => 'hashed',
        ];
    }
}
