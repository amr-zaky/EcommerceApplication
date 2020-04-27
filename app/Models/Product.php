<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $table = 'products';
    protected $hidden = ['createdBy','modifiedBy','created','modified', 'stock', 'sold_count', 'is_published'];
    protected $guarded = ['id'];
    public $timestamps = false;
}
