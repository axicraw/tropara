<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    //
    protected $table = "checkouts";
    protected $fillable = ["user_id", "payment", "address", "payment_type","status", "area_id", "total", 'deliverytime'];

    public function orders(){
    	return $this->hasMany('App\Order', 'checkout_id', 'id');
    }

    public function user(){
    	return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function area(){
    	return $this->hasOne('App\Area', 'id', 'area_id');
    }
}
