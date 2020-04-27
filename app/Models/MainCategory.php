<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MainCategory extends Model
{
    protected $table='mainCategory';
    protected $hidden=['createdBy','modifiedBy','created','modified','display_order','is_active'];
    protected $guarded=['id'];
    public $timestamps = false;

}
