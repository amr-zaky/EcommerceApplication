<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WishList extends Model
{
    protected $table='wish_list';
    protected $hidden=['created_at','updated_at'];
    protected $guarded=['id'];

}
