<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'supplies';
    protected $hidden = ['createdBy','modifiedBy','created','modified'];
    protected $guarded = ['id'];
    public $timestamps = false;

}
