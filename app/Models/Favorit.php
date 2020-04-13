<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorit extends Model
{
    protected $table='favorits';
    protected $hidden=['created_at','updated_at'];
    protected $guarded=['id'];

    public function product()
    {
        return $this->belongsTo(Product::class,'item_id');
    }
    public function vendor()
    {
        return $this->belongsTo(Vendor::class,'item_id');
    }
    public static function toggleRoles()
    {
        return[
            'item_id'=>'required',
            'item_type'=>'required|in:product,vendor',
        ];
    }
}
