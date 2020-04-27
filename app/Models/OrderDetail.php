<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table='order_details';
    protected $hidden=['created','modified'];
    protected $guarded=['id'];
    public $timestamps = false;
}
