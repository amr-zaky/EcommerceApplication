<?php

namespace App\Http\Controllers\Admin;

use App\Libraries\UploadImages;


use App\Models\Offer;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class Offers extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allData = Offer::all();
        return view('AdminPanel.Offer.index')->with('Offers', $allData);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $productData = Product::where('isActive', 1)->get();
        return view('AdminPanel.Offer.form', compact('productData'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(Offer::AddRules());
        $offerObject = $request->only('productId', 'type', 'discountAmount');
        $product = Product::find($offerObject['productId']);
        $inputs['priceBefore'] = $product->price;
        $inputs['type'] = $offerObject['type'];
        $inputs['productId'] = $offerObject['productId'];
        $inputs['discountAmount'] = $offerObject['discountAmount'];
        if ($offerObject['type'] == 'amount') {
            $inputs['priceAfter'] = $product->price - $offerObject['discountAmount'];
        } else {
            $discountAmount = $product->price * ($offerObject['discountAmount'] / 100);
            $inputs['priceAfter'] = $product->price - $discountAmount;
        }
        //check If there is offer for this Product
        $checkOffer = Offer::where('productId', $offerObject['productId']);
        if ($checkOffer) {
            $inputs['createdBy'] = Auth::guard('admin')->id();
            $checkOffer->update($inputs);
        } else {
            $inputs['createdBy'] = Auth::guard('admin')->id();
            Offer::create($inputs);
        }
        return redirect()->route('Offer.index')->with('message', 'Item Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param Offer $Offer
     * @return \Illuminate\Http\Response
     */
    public function changeStatusOffer(Offer $Offer)
    {
        if ($Offer->isActive) {
            $Offer->update(['isActive' => 0]);
        } else {
            $Offer->update(['isActive' => 1]);
        }
        return redirect()->route('Offer.index')->with('message', 'Item Updated Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Offer $Offer
     * @return \Illuminate\Http\Response
     */
    public function edit(Offer $Offer)
    {
        $productData = Product::where('isActive', 1)->get();
        return view('AdminPanel.Offer.form', compact('Offer', 'productData'));
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
        $request->validate(Offer::AddRules());

        $offerObject = $request->only('productId', 'type', 'discountAmount');
        $product = Product::find($offerObject['productId']);
        $inputs['priceBefore'] = $product->price;
        $inputs['type'] = $offerObject['type'];
        $inputs['productId'] = $offerObject['productId'];
        $inputs['discountAmount'] = $offerObject['discountAmount'];
        if ($offerObject['type'] == 'amount') {
            $inputs['priceAfter'] = $product->price - $offerObject['discountAmount'];
        } else {
            $discountAmount = $product->price * ($offerObject['discountAmount'] / 100);
            $inputs['priceAfter'] = $product->price - $discountAmount;
        }

        $inputs['modifiedBy'] = Auth::guard('admin')->id();
        Offer::find($id)->update($inputs);
        return redirect()->route('Offer.index')->with('message', 'تم تعديل صنف ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Offer $Offer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Offer $Offer)
    {
        $Offer->delete();
        return redirect()->route('Offer.index')->with('message', 'Item Deleted Successfully');
    }
}
