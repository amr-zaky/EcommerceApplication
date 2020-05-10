<?php

namespace App\Http\Controllers\Application\User;

use App\Libraries\ApiResponse;
use App\Models\Ads;
use App\Models\Offer;

class HomePage extends MainController
{

    public function adds()
    {
        $adds = Ads::where('endDate', '>', now())
            ->where('isActive', 1)
            ->where('endDate', '>', now())
            ->orderBy('viewOrder', 'ASC')
            ->get();
        return ApiResponse::data(['adds_list' => $adds]);
    }

    public function offers()
    {
        $offers = Offer::where('isActive', 1)
            ->with('product', 'product.productImage')
            ->has('product')
            ->orderBy('viewOrder', 'ASC')
            ->get();
        return ApiResponse::data(['offers_list' => $offers]);
    }


}
