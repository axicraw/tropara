<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $table = "orders";
    protected $fillable = ["checkout_id", "product_id", "nos", "offer_name", "offered_price","status", "pqty"];

    public function checkout(){
    	return $this->belongsTo('App\Checkout', 'checkout_id', 'id');
    }
    public function product(){
    	return $this->belongsTo('App\Product', 'product_id', 'id');
    }
}
