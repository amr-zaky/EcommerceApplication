<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductKeyword extends Model
{
    protected $table='product_keywords';
    protected $hidden=['createdBy','modifiedBy','created','modified'];
    protected $guarded=['id'];
    public $timestamps = false;
}
