<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WishList extends Model
{
    protected $table='wishList';
    protected $hidden=['created','modified'];
    protected $guarded=['id'];
    public $timestamps = false;

}
