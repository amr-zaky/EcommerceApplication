<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductTypeUnit extends Model
{
    protected $table='product_type_units';
    protected $hidden=['createdBy','modifiedBy','created','modified'];
    protected $guarded=['id'];
    public $timestamps = false;

    public function productType()
    {
        return $this->belongsTo(ProductType::class,'typeId');
    }

    public static function AddRules()
    {
        return[
            'value'=>'required',
        ];
    }

}
