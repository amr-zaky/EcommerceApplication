<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Libraries\UploadImages;
use App\Models\MainCategory;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SubCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allData = SubCategory::all();
        return view('AdminPanel.SubCategory.index')->with('SubCategories', $allData);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mainCategories=MainCategory::all();
        return view('AdminPanel.SubCategory.form',compact('mainCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(SubCategory::AddRules());
        $inputs = $request->only('name', 'nameAr', 'displayOrder','mainCategoryId');
        if ($request->hasFile('image')) {
            $imageName = UploadImages::upload('category', request()->file('image'));
            $imageUrl = UploadImages::fullUrl($imageName, 'category');
            $inputs['image'] = $imageUrl;
        }
        $inputs['createdBy'] = Auth::guard('admin')->id();
        SubCategory::create($inputs);
        return redirect()->route('SubCategory.index')->with('message', 'Item Added Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param SubCategory $SubCategory
     * @return \Illuminate\Http\Response
     */
    public function changeStatusSubCategory(SubCategory $SubCategory)
    {
        if ($SubCategory->isActive) {
            $SubCategory->update(['isActive' => 0]);
        } else {
            $SubCategory->update(['isActive' => 1]);
        }
        return redirect()->route('SubCategory.index')->with('message', 'Item Updated Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param SubCategory $SubCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(SubCategory $SubCategory)
    {

        $mainCategories=MainCategory::all();
        return view('AdminPanel.SubCategory.form', compact('SubCategory','mainCategories'));
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
        $request->validate(SubCategory::AddRules());
        $inputs = $request->only('name', 'nameAr', 'displayOrder','mainCategoryId');
        if ($request->hasFile('image')) {
            $SubCategoriesImage = SubCategory::find($id);
            @unlink(public_path($SubCategoriesImage->image));
            $imageName = UploadImages::upload('category', request()->file('image'));
            $imageUrl = UploadImages::fullUrl($imageName, 'category');
            $inputs['image'] = $imageUrl;
        }
        $inputs['modifiedBy'] = Auth::guard('admin')->id();
        SubCategory::find($id)->update($inputs);
        return redirect()->route('SubCategory.index')->with('message', 'تم تعديل صنف ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param SubCategory $SubCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubCategory $SubCategory)
    {
        @unlink($SubCategory->image);
        $SubCategory->delete();
        return redirect()->route('SubCategory.index')->with('message', 'Item Deleted Successfully');
    }
}
