<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MainCategory extends Model
{
    protected $table='main_categories';
    protected $hidden=['createdBy','modifiedBy','created','modified','displayOrder','isActive'];
    protected $guarded=['id'];
    public $timestamps = false;

}
