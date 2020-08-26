<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Professor extends Authenticatable
{
    protected $fillable = ['name', 'email', 'password'];
}