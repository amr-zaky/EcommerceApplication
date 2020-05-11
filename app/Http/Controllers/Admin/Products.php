<?php

namespace App\Http\Controllers\Admin;

use App\Libraries\UploadImages;


use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class Products extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allData = Product::all();
        return view('AdminPanel.Product.index')->with('Products', $allData);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('AdminPanel.Product.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(Product::AddRules());
        $inputs = $request->only('name', 'nameAr', 'displayOrder');
        if ($request->hasFile('image')) {
            $imageName = UploadImages::upload('category', request()->file('image'));
            $imageUrl = UploadImages::fullUrl($imageName, 'category');
            $inputs['image'] = $imageUrl;
        }
        $inputs['createdBy'] = Auth::guard('admin')->id();
        Product::create($inputs);
        return redirect()->route('Product.index')->with('message', 'Item Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param Product $Product
     * @return \Illuminate\Http\Response
     */
    public function changeStatusProduct(Product $Product)
    {
        if ($Product->isActive) {
            $Product->update(['isActive' => 0]);
        } else {
            $Product->update(['isActive' => 1]);
        }
        return redirect()->route('Product.index')->with('message', 'Item Updated Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Product $Product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $Product)
    {

        return view('AdminPanel.Product.form', compact('Product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate(Product::AddRules());
        $inputs = $request->only('name', 'nameAr', 'displayOrder');
        if ($request->hasFile('image')) {
            $ProductImage = Product::find($id);
            @unlink(public_path($ProductImage->image));
            $imageName = UploadImages::upload('category', request()->file('image'));
            $imageUrl = UploadImages::fullUrl($imageName, 'category');
            $inputs['image'] = $imageUrl;
        }
        $inputs['modifiedBy'] = Auth::guard('admin')->id();
        Product::find($id)->update($inputs);
        return redirect()->route('Product.index')->with('message', 'تم تعديل صنف ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $Product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $Product)
    {
        @unlink($Product->image);
        $Product->delete();
        return redirect()->route('Product.index')->with('message', 'Item Deleted Successfully');
    }
}
