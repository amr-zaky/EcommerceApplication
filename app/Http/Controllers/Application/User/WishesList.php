<?php

namespace App\Http\Controllers\Application\User;

use App\Libraries\ApiResponse;
use App\Libraries\ApiValidator;
use App\Models\WishList;

class WishesList extends MainController
{
    public function list()
    {
        $validationProduct = ApiValidator::validate(WishList::listRules());
        if ($validationProduct) {
            return ApiResponse::errors($validationProduct);
        }
        $wishList=WishList::with('product','product.productImage')->has('product')->where('userId',$this->user->id)->select('id','productId')->get();
        return ApiResponse::data(['wishList'=>$wishList]);
    }

    public function addRemove()
    {
        $validationProduct = ApiValidator::validate(WishList::addRules());
        if ($validationProduct) {
            return ApiResponse::errors($validationProduct);
        }

        $productId=request()->productId;
        $userId=$this->user->id;
        $item=WishList::where([
        'productId'=>$productId,
            'userId'=>$userId,
        ])->first();

        if($item)
        {
            $item->delete();
            return ApiResponse::success('Item Deleted Successfully');
        }
        else
        {
            WishList::create([
                'productId'=>$productId,
                'userId'=>$userId
            ]);
            return ApiResponse::success('Item Added Successfully');
        }
    }
}
