<?php

namespace App\Http\Controllers\Application\User;

use App\Libraries\ApiResponse;
use App\Libraries\ApiValidator;
use App\Models\User;
use App\Models\UserAddress;

class UsersAddress extends MainController
{

    public function add()
    {
        $validation = ApiValidator::validateWithNoToken(UserAddress::addRules());
        if ($validation) {
            return ApiResponse::errors($validation);
        }
    }

    public function edit()
    {

    }

    public function delete()
    {

    }

}
