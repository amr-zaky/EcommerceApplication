<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $hidden=['created_at','updated_at'];
    protected $guarded=['id'];

   public function product()
   {
       return $this->belongsTo(Product::class)->select('id','name','ar_name','price','offer_id','currency_id','units','vendor_id');
   }
}
