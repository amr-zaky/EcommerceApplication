<?php

namespace App\Http\Controllers\Admin;

use App\Libraries\UploadImages;


use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class Suppliers extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allData = Supplier::all();
        return view('AdminPanel.Supplier.index')->with('Suppliers', $allData);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('AdminPanel.Supplier.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(Supplier::AddRules());
        $inputs = $request->only('name', 'nameAr', 'title','titleAr','phone');
        if ($request->hasFile('image')) {
            $imageName = UploadImages::upload('product', request()->file('image'));
            $imageUrl = UploadImages::fullUrl($imageName, 'product');
            $inputs['image'] = $imageUrl;
        }
        $inputs['createdBy'] = Auth::guard('admin')->id();
        Supplier::create($inputs);
        return redirect()->route('Supplier.index')->with('message', 'Item Added Successfully');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param Supplier $Supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $Supplier)
    {

        return view('AdminPanel.Supplier.form', compact('Supplier'));
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
        $request->validate(Supplier::AddRules());
        $inputs = $request->only('name', 'nameAr', 'title','titleAr','phone');
        if ($request->hasFile('image')) {
            $SupplierImage = Supplier::find($id);
            @unlink(public_path($SupplierImage->image));
            $imageName = UploadImages::upload('product', request()->file('image'));
            $imageUrl = UploadImages::fullUrl($imageName, 'product');
            $inputs['image'] = $imageUrl;
        }
        $inputs['modifiedBy'] = Auth::guard('admin')->id();
        Supplier::find($id)->update($inputs);
        return redirect()->route('Supplier.index')->with('message', 'تم تعديل صنف ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Supplier $Supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $Supplier)
    {
        @unlink($Supplier->image);
        $Supplier->delete();
        return redirect()->route('Supplier.index')->with('message', 'Item Deleted Successfully');
    }
}
