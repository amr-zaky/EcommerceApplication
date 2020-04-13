<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $table='offers';
    protected $hidden=['created_at','updated_at','start_date','end_date'];
    protected $guarded=['id'];
}
