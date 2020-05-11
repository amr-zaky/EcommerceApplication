<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductRate extends Model
{

    protected $table='rate';
    protected $hidden=['created','modified'];
    protected $guarded=['id'];
    public $timestamps = false;


    public static function addRules()
    {
        return[
            'rate'=>'required|in:1,2,3,4,5',
            'productId'=>'required|exists:products,id',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class,'userId')->select('id','name','image')->withDefault([
         'id'=>0,
         'name' => 'App User',
            'image'=>NULL,
    ]);
    }
}
