<?php

namespace App\Http\Controllers\Application\User;

use App\Libraries\ApiResponse;
use App\Libraries\ApiValidator;
use App\Models\MainCategory;
use App\Models\SubCategories;

class Categories extends MainController
{
    public function mainList()
    {
        $categories = MainCategory::where('is_active',1)->orderBy('display_order','asc')->get();
        return ApiResponse::data(['main_categories'=>$categories]);
    }

    public function subList()
    {

        $validation = ApiValidator::validateWithNoToken(SubCategories::getCateoriesRules());
        if ($validation) {
            return ApiResponse::errors($validation);
        }

        $categories = SubCategories::where([
            'is_active'=>1,
            'main_category_id'=>request()->main_category_id,
        ])->orderBy('display_order','asc')->get();
        return ApiResponse::data(['main_categories'=>$categories]);
    }
}
