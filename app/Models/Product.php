<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $table = 'products';
    protected $hidden = ['created_at', 'updated_at', 'stock', 'sold_count', 'is_published'];
    protected $guarded = ['id'];

    public static function productDetail()
    {
        return [
            'id' => 'required|exists:products,id'
        ];
    }

    public static function updateRules()
    {
        return [
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'description' => 'required',
            'category_id' => 'required|exists:categories,id',
            'offer_id' => 'nullable|exists:offers,id',
            'brand_id' => 'nullable|exists:brands,id',
            'image.*' => 'array|image|mimes:jpeg,png,jpg,gif,svg',
        ];
    }


    public function productImage()
    {
        return $this->hasOne(ProductImage::class);
    }

    public function productsImages()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function offer()
    {

        return $this->belongsTo(Offer::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currencies::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }


    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }


    public function category()
    {
        return $this->belongsTo(Category::class);
    }


}
