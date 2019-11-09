<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $fillable = ['name', 'email','phone', 'password'];

    protected $hidden = [
        'password','updated_at', 'created_at', 'email_verified_at','remember_token'
    ];

    protected $casts = [
        'updated_at', 'created_at'
    ];

    public function booking()
    {
        $this->hasMany(Booking::class);
    }

    public function properties()
    {
        return $this->hasMany(Property::class);
    }
}
