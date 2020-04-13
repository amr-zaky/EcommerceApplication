<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $table = 'products';
    protected $hidden = ['created_at', 'updated_at', 'stock', 'sold_count', 'is_published'];
    protected $guarded = ['id'];
}
