<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Contracts\Auth\MustVerifyEmail; // This tells Laravel the user must verify email
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['username', 'first_name', 'last_name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    protected function casts(): array
    {
        return [
            // Stores the date/time when the user verifies their email
            'email_verified_at' => 'datetime',

            // Automatically hashes the password if you assign a plain password
            'password' => 'hashed',
        ];
    }
}