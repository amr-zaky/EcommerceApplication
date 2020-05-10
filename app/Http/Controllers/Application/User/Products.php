<?php

namespace App\Http\Controllers\Application\User;

use App\Libraries\ApiResponse;
use App\Libraries\ApiValidator;
use App\Models\Product;

class Products extends MainController
{

    public function list()
    {
        $productsQuery = Product::with('productImage', 'offer')->where([
            'isDeleted' => 0,
            'isActive' => 1,
        ])
         ->select('id','name','nameAr','price')
         ->skip($this->getOffset())
         ->take($this->getLimit());
        if (request()->subCategoryId != 0) {
            $productsQuery->where('subCategoryId', request()->subCategoryId);
        }

        if (request()->supplierId != 0) {
            $productsQuery->where('supplierId', request()->supplierId);
        }
        $products=$productsQuery->get();
        return ApiResponse::data(['offset' => $this->nextoffset(), 'products' => $products]);
    }

    public function detail()
    {
        $validationProduct = ApiValidator::validateWithNoToken(Product::productDetail());
        if ($validationProduct) {
            return ApiResponse::errors($validationProduct);
        }

        $product=Product::with('offer','productsImages','supplier','subCategory')->find(request()->id);
        return ApiResponse::data(['product_detail'=>$product]);
    }

}
