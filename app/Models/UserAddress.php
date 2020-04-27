<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    protected $table='userAddress';
    protected $hidden=['created','modified'];
    protected $guarded=['id'];
    public $timestamps = false;
}
