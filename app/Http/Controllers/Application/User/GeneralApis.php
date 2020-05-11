<?php

namespace App\Http\Controllers\Application\User;

use App\Libraries\ApiResponse;
use App\Libraries\ApiValidator;
use App\Models\Complain;
use App\Models\ProductRate;

class GeneralApis extends MainController
{
    public function addComplain()
    {
        $validationProduct = ApiValidator::validate(Complain::addRules());
        if ($validationProduct) {
            return ApiResponse::errors($validationProduct);
        }

        $inputs=request()->only('content');
        $inputs['userId']=$this->user->id;

        Complain::create($inputs);
        return ApiResponse::success('Done Successfully');
    }

    public function rateProduct()
    {
        $validationProduct = ApiValidator::validate(ProductRate::addRules());
        if ($validationProduct) {
            return ApiResponse::errors($validationProduct);
        }

        $inputs=request()->only('rate','productId','comment');
        $inputs['userId']=$this->user->id;
        ProductRate::create($inputs);
        return ApiResponse::success('Done Successfully');
    }

}
