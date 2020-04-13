<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $table='admins';
    protected $hidden=['created_at','updated_at'];
    protected $guarded=['id'];

    public static function loginRules()
    {
        return [
            'email' => 'required',
            'password' => 'required|min:6',
        ];
    }

}
