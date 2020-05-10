<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductTypeUnit extends Model
{
    protected $table='product_type_units';
    protected $hidden=['createdBy','modifiedBy','created','modified','isActive'];
    protected $guarded=['id'];
    public $timestamps = false;
}
