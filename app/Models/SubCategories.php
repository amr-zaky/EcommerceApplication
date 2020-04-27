<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCategories extends Model
{
    protected $table='subCategories';
    protected $hidden=['createdBy','modifiedBy','created','modified','display_order','is_active'];
    protected $guarded=['id'];
    public $timestamps = false;

    public static function getCateoriesRules()
    {
        return[
            'main_category_id'=>'required|exists:main_categories,id'
        ];
    }
}
