<?php

namespace App\Http\Controllers\Application\User;

use App\Libraries\ApiResponse;
use App\Libraries\ApiValidator;
use App\Models\MainCategory;
use App\Models\SubCategory;

class Categories extends MainController
{
    public function mainList()
    {
        $categories = MainCategory::where('isActive',1)->orderBy('displayOrder','asc')->get();
        return ApiResponse::data(['main_categories'=>$categories]);
    }

    public function subList()
    {

        $validation = ApiValidator::validateWithNoToken(SubCategory::getCateoriesRules());
        if ($validation) {
            return ApiResponse::errors($validation);
        }

        $categories = SubCategory::where([
            'isActive'=>1,
            'mainCategoryId'=>request()->main_category_id,
        ])->orderBy('displayOrder','asc')->get();
        return ApiResponse::data(['main_categories'=>$categories]);
    }
}
