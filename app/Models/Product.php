<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $table = 'products';
    protected $hidden = ['createdBy','modifiedBy','created','modified', 'stock', 'soldCount', 'isActive'];
    protected $guarded = ['id'];
    public $timestamps = false;

    public static function listRules()
    {
        return[
            'subCategoryId'=>'required|exists:sub_categories,id',
        ];
    }
}
