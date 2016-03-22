<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Carbon\Carbon;
use App\Offerable;
use App\Category;
use App\Brand;
use App\Product;
use App\Offer;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $offers = Offer::with('products', 'categories')->get();
        return view('admin.offer.offer', compact('offers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.offer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'offer_name' =>'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);
        $offer = new Offer;
        $offer->offer_name = $request->offer_name;
        $offer->description = $request->description;
        $offer->offer_type = $request->offer_type;
        $offer->amount = $request->amount;
        //dd($request);
        if($request->has('active')){
            $offer->active = $request->active;
        }

        $start_date = Carbon::createFromFormat('d-n-Y', $request->start_date);
        $end_date = Carbon::createFromFormat('d-n-Y', $request->end_date);
        $offer->start = $start_date->toDateTimeString();
        $offer->end = $end_date->toDateTimeString();

        $offerfor = $request->offerfor;

        //dd($offerfor);
        $offer->save();
        //dd($offer);
        if($offerfor == 'product'){
            $productIds = $request->products;
            foreach ($productIds as $id) {
                $product = Product::find($id);
                $offer->products()->attach($offer->id, ['offerable_id' => $id, 'offerable_type' => 'App\Product']);
            }

        }elseif($offerfor == 'category'){
            $categoryIds = $request->categories;
            foreach ($categoryIds as $id) {
                $category = Category::find($id);
                $offer->categories()->attach($offer->id, ['offerable_id' => $id, 'offerable_type' => 'App\Category']);
            }
        }elseif($offerfor == 'brand'){
            $brandIds = $request->brands;
            foreach ($brandIds as $id) {
                $brand = Category::find($id);
                $offer->brands()->attach($offer->id, ['offerable_id' => $id, 'offerable_type' => 'App\Brand']);
            }
        }  
        return redirect()->route('admin.offers');
      
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $offer = Offer::with('products', 'categories')->find($id);
        //dd($offer);
        $dates = [
            'start' => Carbon::parse($offer->start)->format('d-n-Y'),
            'end' => Carbon::parse($offer->end)->format('d-n-Y'),
        ];
        return view("admin.offer.edit", compact('offer', 'dates'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'offer_name' =>'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);
        $offer = Offer::find($id);
        $offer->offer_name = $request->offer_name;
        $offer->description = $request->description;
        $offer->offer_type = $request->offer_type;
        $offer->amount = $request->amount;
        //dd($request);
        if($request->has('active')){
            $offer->active = $request->active;
        }else{
             $offer->active = 0;
        }

        $start_date = Carbon::createFromFormat('d-n-Y', $request->start_date);
        $end_date = Carbon::createFromFormat('d-n-Y', $request->end_date);
        $offer->start = $start_date->toDateTimeString();
        $offer->end = $end_date->toDateTimeString();

        $offerfor = $request->offerfor;

        $offer->save(); 
        return redirect()->route('admin.offers');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Offer::destroy($id);
        return back();
    }

    public function ajax_search(){
        $categories = Category::all();
        $products = Product::all();
        $brands = Brand::all();

        $data = ['products'=>$products, 'categories'=>$categories, 'brands'=>$brands];
        //dd($data);
        return response()->json($data);
    }
}
