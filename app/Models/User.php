<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'users';

    protected $fillable = [
        'username',
        'password',
        'nama_lengkap',
        'email',
        'role',
        'foto_profil'
    ];

    protected $hidden = [
        'password',
    ];

    public $timestamps = false; 
}
