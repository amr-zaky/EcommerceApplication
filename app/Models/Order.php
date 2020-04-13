<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table='orders';
    protected $hidden=['created_at','updated_at'];
    protected $guarded=['id'];

    public static function addRoles()
    {
        return[
            'latitude'=>['required','regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
            'longitude'=>['required','regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
            'payment_method'=>'required|in:online,cash',
            'street'=>'required',
            'building'=>'required',
            'floor'=>'required|numeric',
            'apartment'=>'required|numeric',
            'country_id'=>'required|exists:countries,id',
            'city_id'=>'required|exists:cities,id',
            'area_id'=>'required|exists:areas,id',
            'phone'=>'required'
        ];
    }

    public static function listRoles()
    {
        return[
            'type'=>'required|in:new,preparing,delivering,delivered,completed',
        ];
    }

    public static function deliveryRoles()
    {
        return[
            'id'=>'required|exists:orders,id',
            'type'=>'required|in:delivering,delivered',
        ];
    }

    public function orderDetail()
    {
        return $this->hasMany(OrderDetail::class,'order_id');
    }
    public function orderVendor()
    {
        return $this->hasMany(OrderVendor::class,'order_id');
    }

    public static function detailRoles()
    {
        return[
            'id'=>'required|exists:orders,id',
        ];
    }
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
    public function city()
    {
        return $this->belongsTo(City::class);
    }
    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public static function changeStatus()
    {
        return [
            'id'=>'required|exists:orders,id',
            'status'=>'required|in:prepared,preparing,delivering,delivered,completed',
        ];
    }

    public  static  function shippingRoles()
    {
        return [
            'customerLat'=>'required',
            'customerLong'=>'required',
            'vendorsIdArray'=>'required|array',
        ];
    }


}
