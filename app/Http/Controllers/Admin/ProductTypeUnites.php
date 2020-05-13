<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductType;
use App\Models\ProductTypeUnit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ProductTypeUnites extends Controller
{


    public function create(Request $request)
    {
        $ProductTypes=ProductType::all();
        $productId=$request->productId;
        return view('AdminPanel.ProductTypeUnit.form',compact('productId','ProductTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(ProductTypeUnit::AddRules());
        $inputs = $request->only('productId', 'typeId','value');
        $inputs['createdBy'] = Auth::guard('admin')->id();
        ProductTypeUnit::create($inputs);
        return redirect()->back()->with('message', 'Item Added Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ProductTypeUnit $ProductTypeUnit
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductTypeUnit $ProductTypeUnit)
    {
        $ProductTypes=ProductType::all();
        return view('AdminPanel.ProductTypeUnit.form', compact('ProductTypeUnit','ProductTypes'));
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
        $request->validate(ProductTypeUnit::AddRules());
        $inputs = $request->only('productId', 'typeId','value');
        $inputs['modifiedBy'] = Auth::guard('admin')->id();
        ProductTypeUnit::find($id)->update($inputs);
        return redirect()->back()->with('message', 'Item Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ProductTypeUnit $ProductTypeUnit
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductTypeUnit $ProductTypeUnit)
    {
        $ProductTypeUnit->delete();
        return redirect()->back()->with('message', 'Product Unit Deleted Successfully');
    }
}
