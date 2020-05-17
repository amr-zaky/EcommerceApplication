<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ads extends Model
{
    protected $table='ads';
    protected $hidden=['createdBy','modifiedBy','created','modified','startDate','endDate','viewOrder','isActive'];
    protected $guarded=['id'];
    public $timestamps = false;

    public static function addRules()
    {
        return[
            'mediaUrl'=>'required',
            'mediaType'=>'required|in:image,video',
            'startDate'=>'required|date_format:Y-m-d',
            'endDate'=>'required|date_format:Y-m-d|after:today',
            'itemId'=>'required',
            'itemType'=>'required|in:product',
        ];
    }

    public static function updateRules()
    {
        return[
            'startDate'=>'required|date_format:Y-m-d',
            'endDate'=>'required|date_format:Y-m-d|after:today',
            'itemId'=>'required',
            'itemType'=>'required|in:product',
        ];
    }

    public function product()
    {
        return $this->belongsTo(Product::class,'itemId')->where([
            'isDeleted'=>0,
            'isActive'=>1,
        ])->select('id','name');
    }
}
