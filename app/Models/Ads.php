<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ads extends Model
{
    protected $table='ads';
    protected $hidden=['createdBy','modifiedBy','created','modified','start_date','end_date','view_order','is_active'];
    protected $guarded=['id'];

    public static function addRules()
    {
        return[
            'media_url'=>'required',
            'media_type'=>'required|in:image,video',
            'start_date'=>'required|date_format:Y-m-d',
            'end_date'=>'required|date_format:Y-m-d|after:today',
            'item_id'=>'required',
            'item_type'=>'required|in:vendor,product',
            'view_order'=>'required',
        ];
    }

    public static function updateRules()
    {
        return[
            'start_date'=>'required|date_format:Y-m-d',
            'end_date'=>'required|date_format:Y-m-d|after:today',
            'item_id'=>'required',
            'item_type'=>'required|in:vendor,product',
            'view_order'=>'required',
        ];

    }
}
