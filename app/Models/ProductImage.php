<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $table='product_images';
    protected $hidden=['createdBy','modifiedBy','created','modified','displayOrder'];
    protected $guarded=['id'];
    public $timestamps = false;
}
