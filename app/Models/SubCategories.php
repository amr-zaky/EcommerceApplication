<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCategories extends Model
{
    protected $table='sub_categories';
    protected $hidden=['created_at','updated_at','display_order','is_active'];
    protected $guarded=['id'];
}
