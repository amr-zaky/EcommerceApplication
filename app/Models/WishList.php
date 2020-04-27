<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WishList extends Model
{
    protected $table='wish_list';
    protected $hidden=['created','modified'];
    protected $guarded=['id'];
    public $timestamps = false;

    public static function addRules(){

    }
}
