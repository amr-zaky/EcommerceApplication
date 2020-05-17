<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $table='offers';
    protected $hidden=['createdBy','modifiedBy','created','modified','viewOrder','isActive','type'];
    protected $guarded=['id'];
    public $timestamps = false;

    public function product()
    {
        return $this->belongsTo(Product::class,'productId')->where([
            'isDeleted'=>0,
            'isActive'=>1,
        ])->select('id','name','nameAr');
    }

    public function productWeb()
    {
        return $this->belongsTo(Product::class,'productId')->where([
            'isDeleted'=>0,
            'isActive'=>1,
        ])->select('id','name','nameAr');
    }

    public static function AddRules()
    {
        return[
            'productId'=>'required',
            'type'=>'required|in:amount,percentage',
            'discountAmount'=>'required',
        ];
    }


}
