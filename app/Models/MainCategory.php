<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MainCategory extends Model
{
    protected $table='main_categories';
    protected $hidden=['created_at','updated_at','display_order','is_active'];
    protected $guarded=['id'];

}
