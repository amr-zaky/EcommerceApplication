<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table='orders';
    protected $hidden=['created','modified'];
    protected $guarded=['id'];
    public $timestamps = false;
}
