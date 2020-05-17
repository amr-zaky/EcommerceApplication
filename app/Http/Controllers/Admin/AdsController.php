<?php

namespace App\Http\Controllers\Admin;

use App\Libraries\UploadImages;
use App\Libraries\UploadVideo;
use App\Models\Ads;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class AdsController extends Controller
{

    public function index()
    {
        $allData = Ads::orderBy('viewOrder', 'asc')->get();
        return view('AdminPanel.Ads.index')->with('Ads', $allData);
    }

    public function create()
    {
        $productData = Product::where('isActive', 1)->get();
        return view('AdminPanel.Ads.form', compact('productData'));
    }


    public function store(Request $request)
    {
        $request->validate(Ads::addRules());
        $inputs = $request->except('_token', 'mediaUrl');
        if ($inputs['mediaType'] == 'image') {
            $request->validate([
                'mediaUrl' => 'required|mimes:jpeg,jpg,png',
            ]);
            $imageName = UploadImages::upload('ads', $request->file('mediaUrl'));
            $imageUrl = UploadImages::fullUrl($imageName, 'ads');
            $inputs['mediaUrl'] = $imageUrl;
        } else {
            $request->validate([
                'mediaUrl' => 'required|mimes:flv,mp4,3gp,wmv,avi,mov',
            ]);
            $imageName = UploadVideo::upload('ads', $request->file('mediaUrl'));
            $imageUrl = UploadVideo::fullUrl($imageName, 'ads');
            $inputs['mediaUrl'] = $imageUrl;
        }
        $inputs['createdBy'] = Auth::guard('admin')->id();
        Ads::create($inputs);
        return redirect()->route('Ad.index')->with('message', 'Item Added Successfully');
    }


    public function show(Ads $ads)
    {

    }

    public function edit(Ads $Ad)
    {
        $productData = Product::where('isActive', 1)->get();
        return view('AdminPanel.Ads.form', compact('productData', 'Ad'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(Ads::updateRules());
        $inputs = $request->except('_token', 'mediaUrl');
        $Ad = Ads::find($id);
        if ($inputs['mediaType'] == 'image') {
            if ($request->hasFile('mediaUrl')) {
                $request->validate([
                    'mediaUrl' => 'required|mimes:jpeg,jpg,png',
                ]);
                $imageName = UploadImages::upload('ads', $request->file('mediaUrl'));
                $imageUrl = UploadImages::fullUrl($imageName, 'ads');
                @unlink($Ad->mediaUrl);
                $inputs['mediaUrl'] = $imageUrl;
            }
        } else {
            if ($request->hasFile('mediaUrl')) {
                $request->validate([
                    'mediaUrl' => 'required|mimes:flv,mp4,3gp,wmv,avi,mov',
                ]);

                $imageName = UploadVideo::upload('ads', $request->file('mediaUrl'));
                $imageUrl = UploadVideo::fullUrl($imageName, 'ads');
                @unlink($Ad->mediaUrl);
                $inputs['mediaUrl'] = $imageUrl;
            }
        }
        $Ad->update($inputs);
        return redirect()->route('Ad.index')->with('message', 'Item Updated Successfully');
    }

    public function destroy(Ads $Ad)
    {
        @unlink($Ad);
        $Ad->delete();
        return redirect()->route('Ad.index')->with('message', 'Item Deleted Successfully');
    }

    public function changeStatusAd(Ads $Ad)
    {
        if ($Ad->isActive) {
            $Ad->update(['isActive' => 0]);
        } else {
            $Ad->update(['isActive' => 1]);
        }
        return redirect()->route('Ad.index')->with('message', 'Item Updated Successfully');
    }
}
