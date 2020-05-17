<?php

namespace App\Http\Controllers\Admin;

use App\Libraries\UploadImages;


use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductKeyword;
use App\Models\ProductRate;
use App\Models\SubCategory;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class Products extends Controller
{

    public function index()
    {
        $allData = Product::where('isDeleted', 0)->get();
        return view('AdminPanel.Product.index')->with('Products', $allData);
    }

    public function create()
    {
        $subCategories=SubCategory::where('isActive',1)->get();
        $suppliers=Supplier::all();
        return view('AdminPanel.Product.form',compact('suppliers','subCategories'));
    }


    public function store(Request $request)
    {
        $request->validate(Product::AddRules());
        $inputs = $request->only('name', 'nameAr', 'description','descriptionAr','subCategoryId','supplierId','price','stock');
        $inputs['createdBy'] = Auth::guard('admin')->id();
        $product=Product::create($inputs);
        if ($files = $request->file('images')) {
            foreach ($files as $file) {
                $imageName = UploadImages::upload('product', $file);
                $imageUrl = UploadImages::fullUrl($imageName, 'product');
                $imageInputs = [
                    'productId' => $product->id,
                    'image' => $imageUrl,
                    'createdBy'=>Auth::guard('admin')->id(),
                ];
                ProductImage::create($imageInputs);
            }
        }

        return redirect()->route('Product.index')->with('message', 'Item Added Successfully');
    }


    public function show(Product $Product)
    {
        return view('AdminPanel.Product.show', compact('Product'));
    }


    public function changeStatusProduct(Product $Product)
    {
        if ($Product->isActive) {
            $Product->update(['isActive' => 0]);
        } else {
            $Product->update(['isActive' => 1]);
        }
        return redirect()->route('Product.index')->with('message', 'Item Updated Successfully');
    }


    public function edit(Product $Product)
    {
        $subCategories=SubCategory::where('isActive',1)->get();
        $suppliers=Supplier::all();
        return view('AdminPanel.Product.form', compact('Product','suppliers','subCategories'));
    }


    public function update(Request $request, $id)
    {
        $request->validate(Product::AddRules());
        $inputs = $request->only('name', 'nameAr', 'description','descriptionAr','subCategoryId','supplierId','price','stock');
        $inputs['modifiedBy'] = Auth::guard('admin')->id();
        $product=Product::find($id);
        $product->update($inputs);
        if ($files = $request->file('images')) {
            foreach ($files as $file) {
                $imageName = UploadImages::upload('product', $file);
                $imageUrl = UploadImages::fullUrl($imageName, 'product');
                $imageInputs = [
                    'productId' => $product->id,
                    'image' => $imageUrl,
                    'createdBy'=>Auth::guard('admin')->id(),
                ];
                ProductImage::create($imageInputs);
            }
        }
        return redirect()->route('Product.index')->with('message', 'Item Updated Successfully ');
    }


    public function destroy(Product $Product)
    {
        $Product->update([
            'isDeleted'=>1,
            'isActive'=>0,
        ]);
        return redirect()->route('Product.index')->with('message', 'Item Deleted Successfully');
    }


    public function deleteProductImage(ProductImage $ProductImage)
    {
        @unlink($ProductImage->image);
        $ProductImage->delete();
        return redirect()->back()->with('message', 'Image Deleted Successfully');
    }


    public function deleteProductKeyword(ProductKeyword $ProductKeyword)
    {
        $ProductKeyword->delete();
        return redirect()->back()->with('message', 'Product Keyword Deleted Successfully');
    }


    public function deleteProductRate(ProductRate $ProductRate)
    {
        $ProductRate->delete();
        return redirect()->back()->with('message', 'Product Rate Deleted Successfully');
    }


}
