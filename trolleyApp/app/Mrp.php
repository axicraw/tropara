<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mrp extends Model
{
    //
    protected $table = 'mrp';
    protected $fillable = ['product_id', 'mrp', 'qty', 'unit_id'];
    
    public function product(){
    	return $this->belongsTo('App\Product', 'id', 'product_id');
    }    
    public function unit(){
    	return $this->hasOne('App\Unit', 'id', 'unit_id');
    }
   
}
