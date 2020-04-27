<?php

namespace App\Http\Controllers\Application\User;

use App\Libraries\ApiResponse;
use App\Libraries\ApiValidator;
use App\Models\WishList;

class UserWishList extends MainController
{

    public function add()
    {
        $validation = ApiValidator::validate(WishList::addRules());
        if ($validation) {
            return ApiResponse::errors($validation);
        }
        $inputs=request()->only('address');
        $inputs['userId']=$this->user->id;
        UserAddress::create($inputs);
        return ApiResponse::success('done successfully');
    }
}
