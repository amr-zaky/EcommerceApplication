<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $table='productImage';
    protected $hidden=['createdBy','modifiedBy','created','modified'];
    protected $guarded=['id'];
    public $timestamps = false;
}
