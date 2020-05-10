<?php

namespace App\Http\Controllers\Admin;

use App\Libraries\UploadImages;


use App\Models\MainCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MainCategories extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allData = MainCategory::all();
        return view('AdminPanel.MainCategory.index')->with('MainCategories', $allData);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('AdminPanel.MainCategory.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(MainCategory::AddRules());
        $inputs = $request->only('name', 'nameAr', 'displayOrder');
        if ($request->hasFile('image')) {
            $imageName = UploadImages::upload('category', request()->file('image'));
            $imageUrl = UploadImages::fullUrl($imageName, 'category');
            $inputs['image'] = $imageUrl;
        }
        $inputs['createdBy'] = Auth::guard('admin')->id();
        MainCategory::create($inputs);
        return redirect()->route('MainCategory.index')->with('message', 'Item Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param MainCategory $MainCategory
     * @return \Illuminate\Http\Response
     */
    public function changeStatusMainCategory(MainCategory $MainCategory)
    {
        if ($MainCategory->isActive) {
            $MainCategory->update(['isActive' => 0]);
        } else {
            $MainCategory->update(['isActive' => 1]);
        }
        return redirect()->route('MainCategory.index')->with('message', 'Item Updated Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param MainCategory $MainCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(MainCategory $MainCategory)
    {

        return view('AdminPanel.MainCategory.form', compact('MainCategory'));
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
        $request->validate(MainCategory::AddRules());
        $inputs = $request->only('name', 'nameAr', 'displayOrder');
        if ($request->hasFile('image')) {
            $MainCategoryImage = MainCategory::find($id);
            @unlink(public_path($MainCategoryImage->image));
            $imageName = UploadImages::upload('category', request()->file('image'));
            $imageUrl = UploadImages::fullUrl($imageName, 'category');
            $inputs['image'] = $imageUrl;
        }
        $inputs['modifiedBy'] = Auth::guard('admin')->id();
        MainCategory::find($id)->update($inputs);
        return redirect()->route('MainCategory.index')->with('message', 'تم تعديل صنف ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param MainCategory $MainCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(MainCategory $MainCategory)
    {
        @unlink($MainCategory->image);
        $MainCategory->delete();
        return redirect()->route('MainCategory.index')->with('message', 'Item Deleted Successfully');
    }
}
