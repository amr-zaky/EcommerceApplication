<?php

namespace App\Http\Controllers\Application\User;

use App\Libraries\ApiResponse;
use App\Libraries\ApiValidator;
use App\Models\Ads;
use App\Models\MainCategory;
use App\Models\SubCategories;
use App\Models\User;

class HomePage extends MainController
{

    public function adds()
    {
        $adds= Ads::where('end_date', '>', now())
            ->where('is_active',1)
            ->orderBy('view_order', 'ASC')
            ->get();
        return ApiResponse::data(['adds_list'=>$adds]);
    }


}
