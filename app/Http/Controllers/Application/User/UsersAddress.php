<?php

namespace App\Http\Controllers\Application\User;

use App\Libraries\ApiResponse;
use App\Libraries\ApiValidator;
use App\Models\UserAddress;

class UsersAddress extends MainController
{

    public function add()
    {
        $validation = ApiValidator::validate(UserAddress::addRules());
        if ($validation) {
            return ApiResponse::errors($validation);
        }
        $inputs=request()->only('address');
        $inputs['userId']=$this->user->id;
        UserAddress::create($inputs);
        return ApiResponse::success('done successfully');
    }

    public function edit()
    {
        $validation = ApiValidator::validate(UserAddress::editRules());
        if ($validation) {
            return ApiResponse::errors($validation);
        }
        $inputs=request()->only('address','id');
        UserAddress::find($inputs['id'])->update(['address'=>$inputs['address']]);
        return ApiResponse::success('Edit successfully');
    }

    public function delete()
    {
        $validation = ApiValidator::validate(UserAddress::deleteRules());
        if ($validation) {
            return ApiResponse::errors($validation);
        }
        $address=UserAddress::find(request()->id);
        $address->delete();
        return ApiResponse::success('Delete successfully');
    }

}
