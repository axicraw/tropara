<?php

namespace App\Listeners;

use Cart;
use Sentinel;
use App\Price;
use App\Product;
use App\Category;
use App\Tempcart;
use App\Events\AddToCart;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class MakeNewOrder
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  AddToCart  $event
     * @return void
     */
    public function handle(AddToCart $event)
    {
        //
        $price=Price::with('unit')->find($event->priceID);
        $product = Product::with('images', 'offers')->findorfail($event->prodID);
        $category = Category::with('offers')->findorfail($product->category_id);
        //if product has offers
        if($product->offers->count() > 0){
            $offer_price = [];
            $offer_name = [];
            
            foreach($product->offers as $offer)
            {
                //dd($offer->amount);
                if($offer->active == 1)
                {
                    //store offer name
                    array_push($offer_name, $offer->offer_name);
                    if($offer->offer_type == 1)
                    {
                        $tmp_price = ($price->price/100)*$offer->amount;
                        array_push($offer_price, $tmp_price);
                        //dd($tmp_price);
                    }elseif($offer->offer_type == 2)
                    {
                        //dd($offer->amount);
                        array_push($offer_price, $offer->amount);                    
                    }
                }
            }
            if(count($offer_price) > 0){
                $max_offer = max($offer_price);
                $key = array_search($max_offer, $offer_price);//get the key of the selected offer and macth to offer name
                $product_offer_price = $price->price - $max_offer;
                $product_offer_name = $offer_name[$key];
            }else{
                $product_offer_price = $price->price;
                $product_offer_name = "no offer";
            }
        }else{
            $product_offer_price = $price->price;
            $product_offer_name = "no offer";
        }

        //if category has offers
        if($category->offers->count() > 0){
            $offer_price = [];
            $offer_name = [];
            foreach($category->offers as $offer)
            {
                //dd($offer->amount);
                if($offer->active == 1)
                {
                    
                    //store offer name
                    array_push($offer_name, $offer->offer_name);
                    if($offer->offer_type == 1)
                    {
                        $tmp_price = ($price->price/100)*$offer->amount;
                        array_push($offer_price, $tmp_price);
                        //dd($tmp_price);
                    }elseif($offer->offer_type == 2)
                    {
                        //dd($offer->amount);
                        array_push($offer_price, $offer->amount);                    
                    }
                }
            }
            if(count($offer_price) > 0){
                $max_offer = max($offer_price);
                $key = array_search($max_offer, $offer_price);//get the key of the selected offer and macth to offer name
                $category_offer_price = $price->price - $max_offer;
                $category_offer_name = $offer_name[$key];
            }else{
                $category_offer_price = $price->price;
                $category_offer_name = "no offer";
            }
        }else{
            $category_offer_price = $price->price;
            $category_offer_name = "no offer";
        }

        //compare category offer with the product offer and select one
        if($product_offer_price <= $category_offer_price)
        {
            $offered_price = $product_offer_price;
            $offered_name = $product_offer_name;
        }
        else
        {
            $offered_price = $category_offer_price;
            $offered_name = $category_offer_name;   
        }

        Cart::add($product->id, $product->product_name, 1, $offered_price, array('pqty'=>$price->qty, 'pqunit'=>$price->unit->shortform, 'offer_name'=>$offered_name, 'pid'=>$price->id));
        if($user = Sentinel::check())
        {
            $tempcart = Tempcart::create([
                                       'user_id' => $user->id,
                                       'product_id' => $event->prodID,
                                       'pqty_id' => $event->priceID,
                                       'nos' => 1
                                   ]);
        }
        $trolleycart = ['count'=>Cart::count(), 'total'=>Cart::total()];
        //return response()->json($trolleycart);
    }
}
