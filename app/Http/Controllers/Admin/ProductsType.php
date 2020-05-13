<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ProductsType extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allData = ProductType::all();
        return view('AdminPanel.ProductType.index')->with('ProductsType', $allData);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('AdminPanel.ProductType.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(ProductType::AddRules());
        $inputs = $request->only('name', 'nameAr');
        $inputs['createdBy'] = Auth::guard('admin')->id();
        ProductType::create($inputs);
        return redirect()->route('ProductType.index')->with('message', 'Item Added Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ProductType $ProductType
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductType $ProductType)
    {

        return view('AdminPanel.ProductType.form', compact('ProductType'));
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
        $request->validate(ProductType::AddRules());
        $inputs = $request->only('name', 'nameAr');
        $inputs['modifiedBy'] = Auth::guard('admin')->id();
        ProductType::find($id)->update($inputs);
        return redirect()->route('ProductType.index')->with('message', 'Item Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ProductType $ProductType
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductType $ProductType)
    {
        $ProductType->delete();
        return redirect()->route('ProductType.index')->with('message', 'Item Deleted Successfully');
    }
}
