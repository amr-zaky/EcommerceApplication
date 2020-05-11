<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $table='sub_categories';
    protected $hidden=['createdBy','modifiedBy','created','modified','displayOrder','isActive'];
    protected $guarded=['id'];
    public $timestamps = false;

    public static function getCateoriesRules()
    {
        return[
            'main_category_id'=>'required|exists:main_categories,id'
        ];
    }

    public static function AddRules()
    {
        return [
            'name'=>'required',
            'nameAr'=>'required',
            'image'=>'image|mimes:jpeg,png,jpg',
            'mainCategoryId'=>'required|exists:main_categories,id',
        ];
    }

    public function mainCategory()
    {
        return $this->belongsTo(MainCategory::class,'mainCategoryId');
    }
}
