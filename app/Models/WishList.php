<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WishList extends Model
{
    protected $table='wish_list';
    protected $hidden=['created','modified'];
    protected $guarded=['id'];
    public $timestamps = false;

    public static function listRules()
    {
        return[];
    }
    public static function addRules(){
        return[
            'productId'=>'required|exists:products,id',
        ];
    }

    public function product()
    {
        return $this->belongsTo(Product::class,'productId')->where([
            'isDeleted'=>0,
            'isActive'=>1,
        ])->select('id','name','nameAr');
    }
}
