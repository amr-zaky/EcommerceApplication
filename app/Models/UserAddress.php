<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    protected $table='users_address';
    protected $hidden=['created','modified'];
    protected $guarded=['id'];
    public $timestamps = false;

    public static function addRules()
    {
     return[
         'address'=>'required'
     ];
    }

    public static function editRules()
    {
        return[
            'id'=>'required|exists:users_address,id',
            'address'=>'required',
        ];
    }

    public static function deleteRules()
    {
        return[
            'id'=>'required|exists:users_address,id',
        ];
    }
}
