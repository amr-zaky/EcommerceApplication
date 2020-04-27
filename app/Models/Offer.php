<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $table='offers';
    protected $hidden=['createdBy','modifiedBy','created','modified','start_date','end_date'];
    protected $guarded=['id'];
    public $timestamps = false;
}
