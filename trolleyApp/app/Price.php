<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    //
    protected $table = 'prices';
    protected $fillable = ['product_id', 'price', 'qty', 'unit_id'];
    public function product(){
    	return $this->belongsTo('App\Product', 'id', 'product_id');
    }
    public function unit(){
    	return $this->hasOne('App\Unit', 'id', 'unit_id');
    }
}
