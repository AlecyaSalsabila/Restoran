<?php

namespace App\Models;

use Illuminate\Support\Str;


use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;



class User extends Authenticatable
{

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [ 
        'email_verified_at' => 'datetime',
        'password' => 'hashed', 
    ];

    public function isAdmin()
    {
        return Str::endsWith($this->email, '@admin.com');
    }

}
