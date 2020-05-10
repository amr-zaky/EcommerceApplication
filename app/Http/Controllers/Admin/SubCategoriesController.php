<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Libraries\UploadImages;
use App\Models\MainCategory;
use App\Models\SubCategories;
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
        $allData = SubCategories::all();
        return view('AdminPanel.SubCategories.index')->with('SubCategories', $allData);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mainCategory=MainCategory::all();
        return view('AdminPanel.SubCategories.form',compact('mainCategory'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(SubCategories::AddRules());
        $inputs = $request->only('name', 'nameAr', 'displayOrder');
        if ($request->hasFile('image')) {
            $imageName = UploadImages::upload('category', request()->file('image'));
            $imageUrl = UploadImages::fullUrl($imageName, 'category');
            $inputs['image'] = $imageUrl;
        }
        $inputs['createdBy'] = Auth::guard('admin')->id();
        SubCategories::create($inputs);
        return redirect()->route('SubCategories.index')->with('message', 'Item Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param SubCategories $SubCategories
     * @return \Illuminate\Http\Response
     */
    public function changeStatusSubCategories(SubCategories $SubCategories)
    {
        if ($SubCategories->isActive) {
            $SubCategories->update(['isActive' => 0]);
        } else {
            $SubCategories->update(['isActive' => 1]);
        }
        return redirect()->route('SubCategories.index')->with('message', 'Item Updated Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param SubCategories $SubCategories
     * @return \Illuminate\Http\Response
     */
    public function edit(SubCategories $SubCategories)
    {

        return view('AdminPanel.SubCategories.form', compact('SubCategories'));
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
        $request->validate(SubCategories::AddRules());
        $inputs = $request->only('name', 'nameAr', 'displayOrder');
        if ($request->hasFile('image')) {
            $SubCategoriesImage = SubCategories::find($id);
            @unlink(public_path($SubCategoriesImage->image));
            $imageName = UploadImages::upload('category', request()->file('image'));
            $imageUrl = UploadImages::fullUrl($imageName, 'category');
            $inputs['image'] = $imageUrl;
        }
        $inputs['modifiedBy'] = Auth::guard('admin')->id();
        SubCategories::find($id)->update($inputs);
        return redirect()->route('SubCategories.index')->with('message', 'تم تعديل صنف ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param SubCategories $SubCategories
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubCategories $SubCategories)
    {
        @unlink($SubCategories->image);
        $SubCategories->delete();
        return redirect()->route('SubCategories.index')->with('message', 'Item Deleted Successfully');
    }
}
