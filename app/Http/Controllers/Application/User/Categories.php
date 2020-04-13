<?php

namespace App\Http\Controllers\Application\User;

use App\Libraries\ApiResponse;
use App\Libraries\ApiValidator;
use App\Models\MainCategory;
use App\Models\SubCategories;
use App\Models\User;

class Categories extends MainController
{
    public function mainList()
    {
        $categories = MainCategory::where('is_active',1)->orderBy('display_order','asc')->get();
        return ApiResponse::data(['main_categories'=>$categories]);
    }

    public function subList()
    {
        $categories = SubCategories::where([
            'is_active'=>1,
        ])->orderBy('display_order','asc')->get();
        return ApiResponse::data(['main_categories'=>$categories]);
    }
}
