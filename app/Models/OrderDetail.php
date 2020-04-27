<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table='orderDetail';
    protected $hidden=['created','modified'];
    protected $guarded=['id'];
    public $timestamps = false;
}
