<?php

namespace App\Http\Controllers\Application\User;

use App\Libraries\ApiResponse;
use App\Libraries\ApiValidator;
use App\Models\Product;

class Products extends MainController
{

    public function list()
    {
        $validation = ApiValidator::validateWithNoToken(Product::listRules());
        if ($validation) {
            return ApiResponse::errors($validation);
        }
    }

}
