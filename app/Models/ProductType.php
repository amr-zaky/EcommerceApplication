<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{

    protected $table='product_type';
    protected $hidden=['created','modified'];
    protected $guarded=['id'];
    public $timestamps = false;

    public static function AddRules()
    {
        return[
            'name'=>'required',
            'nameAr'=>'required',
        ];
    }
}
