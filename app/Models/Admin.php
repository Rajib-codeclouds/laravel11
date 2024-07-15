<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;
use MongoDB\Laravel\Auth\User as Authenticatable;
use MongoDB\Laravel\Eloquent\Model as Model;

class Admin extends Authenticatable
{
    use HasFactory;
    protected $guard = 'admin';

     protected $fillable = [
        'name',
        'email',
        'password',
    ];

     protected $hidden = [
        'password',
        'remember_token',
    ];
}
