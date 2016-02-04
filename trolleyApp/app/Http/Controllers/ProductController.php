<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;
use App\Category;
use App\Brand;
use App\Unit;
use App\Image;
use App\Description;
use App\Price;
use App\Mrp;
use Input;
use Storage;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pagin($id){

        $brands = Brand::all();
        $categories = Category::all();
        $itemsPerPage = 15;
        $pageProducts = Product::with('prices', 'prices.unit', 'mrp', 'mrp.unit')->forPage($id, $itemsPerPage)->get();
        $count = Product::all()->count();
        $products = new LengthAwarePaginator($pageProducts, $count, $itemsPerPage, $id);
        return view('admin/product/product', compact('products', 'categories', 'brands'));
    }    
    public function pagindirection($id, $direction){

        if($direction == 'next'){
            $id = $id+1;
        }elseif($direction == 'prev'){
            $id = $id-1;
        }
        $brands = Brand::all();
        $categories = Category::all();
        $itemsPerPage = 15;
        $pageProducts = Product::with('prices', 'prices.unit', 'mrp', 'mrp.unit')->forPage($id, $itemsPerPage)->get();
        $count = Product::all()->count();
        $products = new LengthAwarePaginator($pageProducts, $count, $itemsPerPage, $id);
        //dd($products);
        return view('admin/product/product', compact('products', 'categories', 'brands'));
    }
    public function search($key){
        // $brands = Brand::all();
        // $categories = Category::all();
        $key = trim($key);
        if(strlen($key) > 0){

            $products = Product::with('category', 'brand')
                                ->where('product_name', 'LIKE','%'.$key.'%')
                                ->orWhereHas('category', function ($q) use ($key) {
                                    $q->where('category_name', 'LIKE', '%'.$key.'%');
                                })
                                ->orWhereHas('brand', function ($q) use ($key) {
                                    $q->where('brand_name', 'LIKE', '%'.$key.'%');
                                })
                                ->get();

            return response()->json($products);
        }
        return response(0);
    }
    public function index()
    {
        //

        $brands = Brand::all();
        $categories = Category::all();
        $itemsPerPage = 15;
        $pageProducts = Product::with('prices', 'prices.unit', 'mrp', 'mrp.unit')->forPage(1, $itemsPerPage)->get();
        $count = Product::all()->count();
        $products = new LengthAwarePaginator($pageProducts, $count, $itemsPerPage, 1);
        //dd($brands);
        return view('admin/product/product', compact('products', 'categories', 'brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::all();
        $brands = Brand::all();
        $units = Unit::all();
        return view('admin/product/create', compact('categories', 'brands', 'units'));
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
        $this->validate($request,[
            'product_name'=>'required',
            'category_id'=>'required',
        ]);

        $input = $request->all();
        //dd($input);
        $product = Product::create($input);
        // if($request->hasFile('prod_image')){
           
        //     $images = $request->file('prod_image');
        //      //dd($images);
        //     foreach($images as $image){
        //         if($image != null){
        //             var_dump('found image');
        //             $image_name = $image->getClientOriginalName();
        //             $image->move(public_path().'/images/products/', $image_name);
        //             $newImage = Image::create(['image_name'=>$image_name]);
        //             $product->images()->attach($newImage->id);
        //         }
        //     }
        // }else{
        //     dd('file not found');
        // }
        // $description = [
        //     'description' => $request->description,
        //     'product_id' => $product->id
        // ];
        // Description::create($description);
        return redirect()->route('admin.product.show', [$product->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //dd($id);
        //
        //
        $brands = Brand::all();
        $categories = Category::all();
        $product = Product::with('description')->find($id);
        $prices = $product->prices;
        $mrp = Mrp::with('unit')->where('product_id', $id)->first();
        //dd($mrp);
        $images = $product->images;
        $units = Unit::all();
        return view('admin/product/edit', compact('product', 'categories', 'brands', 'images', 'units', 'prices', 'mrp'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {


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
        //
         $this->validate($request,[
            'product_name'=>'required',
            'category_id'=>'required',
        ]);

        $product = Product::find($id);
        $input = $request->all();
        //dd($input);
        $product->fill($input);
        if(!$request->has('out_of_stock')){
            $product->out_of_stock = 0;
        }
        if(!$request->has('active')){
            $product->active = 0;
        }
        $product->save();
        $mrpInput = [
            'qty' => $request->mrp_qty,
            'unit_id' => $request->mrp_unit_id,
            'mrp' => $request->mrp_mrp
        ];
        $mrp = Mrp::firstOrNew(array('product_id'=>$id));
        $mrp->fill($mrpInput);
        $mrp->save();
        if($request->hasFile('prod_image')){
           
            $images = $request->file('prod_image');
            // dd($images);
            foreach($images as $image){
                if($image != null){
                    $image_name = $image->getClientOriginalName();
                    $image->move(public_path().'/images/products/', $image_name);
                    $status = $image->getError();
                    if($status);{
                        dd($status);
                    }
                    $newImage = Image::create(['image_name'=>$image_name]);
                    $product->images()->attach($newImage->id);
                }
            }
        }

        $description = Description::firstOrNew(array('product_id'=>$id));
        $description->description = $request->description;
        $description->save();
        return redirect()->route('admin.product.index');
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
        Product::destroy($id);
        return redirect()->route('admin.product.index');
    }

    public function updateImage(Request $request){
        $product = Product::find($request->prodid);
        Image::destroy($request->imageid);
        return response()->json('true');
    }

    public function createPrice(Request $request){
        $this->validate($request, [
            'price'=>'required',
            'qty'=>'required',
            'unit_id'=>'required'
        ]);

        $product = Product::find($request->product_id);
        Price::create($request->all());

        return response()->json('true');
    }
    public function updatePrice(Request $request, $id){
        $price = Price::find($id);
        $price->fill($request->all());
        $price->save();
        return response()->json('true');
    }
    public function getPrices($id){
        $prices = Price::where('product_id', $id)->get();
        return response()->json($prices);
    }
    public function deletePrice($id){
        Price::destroy($id);
        return response()->json('true');
    }
    public function deleteImage($prod_id, $image_id){
        //$image=Image::where('image_id', $id);
        $product = Product::find($prod_id);
        $product->images()->detach($image_id);
        return response()->json('true');
    }
}
