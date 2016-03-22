<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Sentinel;
use Cart;
use Event;
use DB;
use Carbon\Carbon;
use App\Tempcart;
use App\User;
use App\Area;
use App\Flashtext;
use App\Events\MadeCheckout;
use App\Events\AddToCart;
use App\Product;
use App\Category;
use App\Price;
use App\Checkout;
use App\Order;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    public function addP2C($prodID, $priceID){
        Event::fire(new AddToCart($priceID, $prodID));
        // $price=Price::with('unit')->find($priceID);
        // $product = Product::with('images', 'offers')->findorfail($prodID);
        // $category = Category::with('offers')->findorfail($product->category_id);
        // //if product has offers
        // if($product->offers->count() > 0){
        //     $offer_price = [];
        //     $offer_name = [];
            
        //     foreach($product->offers as $offer)
        //     {
        //         //dd($offer->amount);
        //         if($offer->active == 1)
        //         {
        //             //store offer name
        //             array_push($offer_name, $offer->offer_name);
        //             if($offer->offer_type == 1)
        //             {
        //                 $tmp_price = ($price->price/100)*$offer->amount;
        //                 array_push($offer_price, $tmp_price);
        //                 //dd($tmp_price);
        //             }elseif($offer->offer_type == 2)
        //             {
        //                 //dd($offer->amount);
        //                 array_push($offer_price, $offer->amount);                    
        //             }
        //         }
        //     }
        //     if(count($offer_price) > 0){
        //         $max_offer = max($offer_price);
        //         $key = array_search($max_offer, $offer_price);//get the key of the selected offer and macth to offer name
        //         $product_offer_price = $price->price - $max_offer;
        //         $product_offer_name = $offer_name[$key];
        //     }else{
        //         $product_offer_price = $price->price;
        //         $product_offer_name = "no offer";
        //     }
        // }else{
        //     $product_offer_price = $price->price;
        //     $product_offer_name = "no offer";
        // }

        // //if category has offers
        // if($category->offers->count() > 0){
        //     $offer_price = [];
        //     $offer_name = [];
        //     foreach($category->offers as $offer)
        //     {
        //         //dd($offer->amount);
        //         if($offer->active == 1)
        //         {
                    
        //             //store offer name
        //             array_push($offer_name, $offer->offer_name);
        //             if($offer->offer_type == 1)
        //             {
        //                 $tmp_price = ($price->price/100)*$offer->amount;
        //                 array_push($offer_price, $tmp_price);
        //                 //dd($tmp_price);
        //             }elseif($offer->offer_type == 2)
        //             {
        //                 //dd($offer->amount);
        //                 array_push($offer_price, $offer->amount);                    
        //             }
        //         }
        //     }
        //     if(count($offer_price) > 0){
        //         $max_offer = max($offer_price);
        //         $key = array_search($max_offer, $offer_price);//get the key of the selected offer and macth to offer name
        //         $category_offer_price = $price->price - $max_offer;
        //         $category_offer_name = $offer_name[$key];
        //     }else{
        //         $category_offer_price = $price->price;
        //         $category_offer_name = "no offer";
        //     }
        // }else{
        //     $category_offer_price = $price->price;
        //     $category_offer_name = "no offer";
        // }

        // //compare category offer with the product offer and select one
        // if($product_offer_price <= $category_offer_price)
        // {
        //     $offered_price = $product_offer_price;
        //     $offered_name = $product_offer_name;
        // }
        // else
        // {
        //     $offered_price = $category_offer_price;
        //     $offered_name = $category_offer_name;   
        // }
        // Cart::add($product->id, $product->product_name, 1, $offered_price, array('pqty'=>$price->qty, 'pqunit'=>$price->unit->shortform, 'offer_name'=>$offered_name, 'pid'=>$price->id));
        // $trolleycart = ['count'=>Cart::count(), 'total'=>Cart::total()];
        return response()->json("add to Cart");
    }

    public function updateNos(Request $request){
        $row = Cart::update($request->id, $request->nos);
        if($user = Sentinel::check())
        {
            $tempcart = Tempcart::where('user_id', $user->id)
                                ->where('product_id', $request->product_id)
                                ->where('pqty_id', $request->pqty_id)
                                ->first();
            $tempcart->nos = $request->nos;
            $tempcart->save();

        }
        return response()->json($row) ;
    }

    public function remove($id){
        $order = Cart::get($id);
        if($user = Sentinel::check())
        {
            $tempcart = Tempcart::where('user_id', $user->id)
                                ->where('product_id', $order->id)
                                ->where('pqty_id', $order->options->pid)
                                ->delete();
        }
        Cart::remove($id);
        $trolleycart = ['count'=>Cart::count(), 'total'=>Cart::total()];
        return response()->json($trolleycart);
    }

    public function view(Request $request){
        $cart = Cart::content();
        $total = Cart::total();
        $count = Cart::count();
        if($total < 250){
            if($request->session()->has('deli_area'))
            {
                $id = $request->session()->get('deli_area');
                $area = Area::findorfail($id);
                $delivery_cost = $area->delivery_cost;
            }
            $delivery_cost = 20;
        }else{
            $delivery_cost = 'unknown';
        }
        $flashes = Flashtext::where('active', '1')->get();
        $areas = Area::where('deliverable', '1')->get();

        //dd($cart);
        if($user = Sentinel::check()){
            $user = User::findorfail($user->id);
        }else{
            $user = null;
        }
       
        //dd($cart);
        return view('site/cart', compact('cart', 'count', 'total', 'user',  'flashes', 'areas', 'delivery_cost'));
    }

    public function get(){
        $trolleycart = ['count'=>Cart::count(), 'total'=>Cart::total()];
        return response()->json($trolleycart);
    }

    public function checkout(Request $request){
        //if cart is set then checkout
        //** if cod set payment status to cod
        if($cart = Cart::content())
        { 
            //check for payment success 
            $checkout = true; //user paymet success
            $payment_type = 'cod';

            
            if($checkout){

                //get the user who made purchase
                $user = Sentinel::check();
                
                //check if temp address is isset
                if ($request->session()->has('tmp_address')) {
                    //
                    $address = $request->session()->get('tmp_address');
                }else{
                    $address = $user->address;
                }

                    if($area_id = $user->area_id)
                    {
                        //$delivery_cost = $areas->find($area_id)->delivery_cost;
                    }
                    elseif($area_id = $request->session()->get('deli_area'))
                    {
                        //$delivery_cost = $areas->find($area_id)->delivery_cost;
                    }
                    else
                    {
                        $area_id = "unknown";
                    }
                //dd($address);
                if ($request->session()->has('deli_time')) {
                    //
                    $deli_id = $request->session()->get('deli_time');
                    $dt = DB::table('deliverytimes')->where('id', $deli_id)->first();

                }else{
                    $dt = DB::table('deliverytimes')->first();

                }
                //dd($dt);
                if($dt)
                {
                    $start =Carbon::parse($dt->start)->format('h:ia');
                    $stop = Carbon::parse($dt->stop)->format('h:ia');
                    $delivery_time = $start.'-'.$stop;
                }
                else{
                    $start =Carbon::now()->format('h:ia');
                    $stop = Carbon::now()->format('h:ia');
                    $delivery_time = $start.'-'.$stop;
                }
                //dd($delivery_time);
                $total = Cart::total();
                $areas = Area::all();
                //calculate the total and delivery cost
                if($total < 250)
                {
                    if($area_id)
                    {
                        $delivery_cost = $areas->find($area_id)->delivery_cost;
                    }
                    else
                    {
                        $delivery_cost = "0";
                    }
                }
                else
                {
                    $delivery_cost = "0";
                }

                $total = $total + $delivery_cost;

                //dd($total);
                //create checkout and set user to it and also set payment status
                $checkout = Checkout::create(['user_id'=>$user->id, 'area_id'=>$area_id, 'payment'=>false, 'payment_type'=>$payment_type, 'status'=>'not confirmed', 'deliverytime'=>$delivery_time, 'total'=>$total]);
                //dd($checkout);
                //if address is set then add to checkout 
                if($address){
                    $checkout->address = $address;
                    $checkout->save();
                }
                if($checkout)
                {

                    //create order list 
                    foreach ($cart as $order)
                    {
                        //dd($order);
                        $newOrderinput = [
                            'checkout_id' => $checkout->id,
                            'product_id' => $order->id,
                            'nos' => $order->qty,
                            'offer_name' => $order->offer_name,
                            'offered_price' => $order->price,
                            'pqty' => $order->options->pqty.$order->options->pqunit
                        ];
                        //insert offer name
                        if($offer_name = $order->offer_name)
                        {
                            $newOrderinput['offer_name'] = $offer_name;
                        }
                        else
                        {
                            $newOrderinput['offer_name'] = "no offer";
                        }
                        //dd($newOrderinput);
                        Order::create($newOrderinput);
                    }
                }
                $checkout->status = "Order Placed";
                $checkout->save();
                Cart::destroy();  
                if($user = Sentinel::check()){
                    $user = User::findorfail($user->id);
                    Event::fire(new MadeCheckout($user, $checkout));
                    //temp cart gets deleted in the listener
                }
                 //clear cart data
               
            }

        }
        $notification = "Thankyou. Your order has been successfully placed. <br> Continue <a href='/'>shopping</a>.";
        return view('site.notification', compact('notification'));
    }

    public function address(Request $request, $id){

    }

    public function changeaddress(Request $request){
        $input = $request->all();
        $tmp_address = $input['title'].'.'.$input['name'].",\r\n";
        $tmp_address .= $input['address'];
        $request->session()->put('tmp_address', $tmp_address);

        $areaid = $input['area_id'];
        $request->session()->put('deli_area', $areaid);
        return back();
    }

    public function myaddress(Request $request){
        $request->session()->forget('tmp_address');
        return back();
    }

    public function confirmOrder($checkout_id){
        $checkout = Checkout::findorfail($checkout_id);
        $checkout->status = "Order Placed";
        $checkout->save();
        $user = Sentinel::check();
        $user = User::findorfail($user->id);
        Event::fire(new MadeCheckout($user, $checkout));
        Cart::destroy(); //clear cart data
        return redirect()->route('cart.orderplaced');
    }

    public function orderplaced(){
        return view('site.orderplaced');
    }

    public function paymentmode(Request $request){
        //get details from cart not from checkout
        // rewrite this controller

        //$checkout = Checkout::with('orders')->findorfail($checkout_id);
        $user = Sentinel::check();
        $user = User::findorfail($user->id);
        $cart = Cart::content();
        $noofitems = Cart::count();
        $total = Cart::total();
        if ($request->session()->has('tmp_address')) {
            $address = $request->session()->get('tmp_address');
        }else{
            $address = $user->address;
        }

        // foreach($cart as $row)
        // {
        //     $tempcart = Tempcart::create([
        //                    'user_id' => $user->id,
        //                    'product_id' => $row->id,
        //                    'pqty_id' => $row->options->pid,
        //                    'nos' => 1
        //                ]);
        // }
        $flashes = Flashtext::where('active', '1')->get();
        $areas = Area::where('deliverable', '1')->get();
        if($total < 250)
        {
            if($area_id = $user->area_id)
            {
                $delivery_cost = $areas->find($area_id)->delivery_cost;
            }
            elseif($area_id = $request->session()->get('deli_area'))
            {
                $delivery_cost = $areas->find($area_id)->delivery_cost;
            }
            else
            {
                $delivery_cost = "unknown";
            }
        }
        else
        {
            $delivery_cost = "0";
        }
        return view('site.paymentmode', compact('user', 'cart', 'noofitems', 'total', 'address', 'flashes', 'areas', 'delivery_cost'));
    }

    public function changeArea(Request $request){

        $input = $request->all();
        if($request->has('area')){
            $areaid = $input['area'];
            $request->session()->put('deli_area', $areaid);
        }
        if($request->has('time')){
            $time = $input['time'];
            $request->session()->put('deli_time', $time);
        }

        if($request->ajax())
        {

            $request->session()->forget('vistor');
            return response()->json('changed successfully');
        }
        return back();
    }
   
    public function tempcart(Requset $request){
        if(Request::ajax())
        {
            $user = Sentinel::check();
            $user = User::findorfail($user->id);
            return response()->json('tempcart');
        }
        return back();
    }
}
