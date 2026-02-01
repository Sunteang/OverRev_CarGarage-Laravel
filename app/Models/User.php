<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'tbl_users';

    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
        'avatar',
        'role', // <-- important
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Role helpers
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isUser(): bool
    {
        return $this->role === 'user';
    }

    public function favourites()
    {
        return $this->belongsToMany(Car::class, 'tbl_favourites', 'user_id', 'car_id')
            ->withTimestamps();
    }

    // Automatically hash password
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::needsRehash($password) ? Hash::make($password) : $password;
    }
}
