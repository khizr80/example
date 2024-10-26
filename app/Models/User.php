<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory; // Import the HasFactory trait

class User extends Authenticatable
{
    use Notifiable, HasFactory; // Include HasFactory

    protected $table = 'webuser'; // Specify the custom table name

    protected $fillable = [
        'name',
        'username',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
