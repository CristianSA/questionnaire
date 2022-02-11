<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable, HasFactory;

    protected $guard = 'admin';

    protected $fillable = [
        'name', 'nickname', 'email', 'password', 'status',
    ];

    protected $hidden = [
        'password'
    ];

}
