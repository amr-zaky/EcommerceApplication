<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $table='admins';
    protected $hidden=['createdBy','modifiedBy','created','modified'];
    protected $guarded=['id'];
    public $timestamps = false;

    public static function loginRules()
    {
        return [
            'email' => 'required',
            'password' => 'required|min:6',
        ];
    }
    public static function editRules($id)
    {
        return[
            'email' => 'required|email|unique:users,email,' . $id,
            'password' =>'confirmed|min:6',
        ];
    }
}
