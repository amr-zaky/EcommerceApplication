<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    protected $table='users_address';
    protected $hidden=['created_at','updated_at'];
    protected $guarded=['id'];
}
