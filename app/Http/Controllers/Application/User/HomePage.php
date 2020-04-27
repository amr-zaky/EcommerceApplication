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
        $adds= Ads::where('endDate', '>', now())
            ->where('isActive',1)
            ->orderBy('viewOrder', 'ASC')
            ->get();
        return ApiResponse::data(['adds_list'=>$adds]);
    }


}
