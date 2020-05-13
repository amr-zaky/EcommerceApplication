<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $table = 'products';
    protected $hidden = ['createdBy','modifiedBy','created','modified', 'stock', 'soldCount', 'isActive','isNew','isDeleted'];
    protected $guarded = ['id'];
    public $timestamps = false;

    public static function productDetail()
    {
        return[
            'id'=>'required|exists:products,id'
        ];
    }
    public function productImage()
    {
        return $this->hasOne(ProductImage::class,'productId');
    }
    public function productsImages()
    {
        return $this->hasMany(ProductImage::class,'productId');
    }
    public function offer()
    {
        return $this->hasOne(Offer::class,'productId')->where('isActive',1);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class,'supplierId')->select('id','name','nameAr','image');
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class,'subCategoryId')->select('id','name','nameAr','image');
    }

    public function productUnits()
    {
        return $this->hasMany(ProductTypeUnit::class,'productId')->orderBy('typeId');
    }

    public function productKeyword()
    {
        return $this->hasMany(ProductKeyword::class,'productId');
    }
    public function rate()
    {
        return $this->hasMany(ProductRate::class,'productId');
    }


    public static function AddRules()
    {
        return[
            'name'=>'required',
            'description'=>'required',
            'nameAr'=>'required',
            'descriptionAr'=>'required',
            'price'=>'required',
            'stock'=>'required',
            'images.*' => 'image|mimes:jpeg,png,jpg',
        ];
    }

}
