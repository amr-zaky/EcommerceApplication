<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Complain extends Model
{
    protected $table='complaints';
    protected $hidden=['created','updated'];
    protected $guarded=['id'];
    public $timestamps = false;

    public static function addRules()
    {
        return[
            'content'=>'required',
        ];
    }
}
