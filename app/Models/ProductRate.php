<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductRate extends Model
{

    protected $table='Rate';
    protected $hidden=['created','modified'];
    protected $guarded=['id'];
    public $timestamps = false;
}
