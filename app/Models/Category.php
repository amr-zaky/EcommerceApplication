<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $table='categories';
    protected $hidden=['created_at','updated_at','display_order'];
    protected $guarded=['id'];

    public static function CategoryDetail()
    {
        return [
            'id'=>'required|exists:categories,id'
        ];
    }

    public static function subCategoryRolue()
    {
        return [
            'category_id'=>'required|exists:categories,id'
        ];
    }

    public static function AddRules()
    {
        return [
            'arabic_name'=>'required',
            'english_name'=>'required',
            'category_id'=>'exists:categories,id'
        ];
    }

    public  function subCategory(){
        return $this->hasMany(Category::class,'category_id');
    }
    public  function offer()
    {
        return $this->hasOne(Offer::class)->select('id','discount','category_id');
    }
}
