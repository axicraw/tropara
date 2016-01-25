<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
	protected $table = "products";
    protected $fillable = ['product_name', 'local_name', 'out_of_stock', 'active', 'brand_id', 'category_id'];

    public function category(){
    	return $this->belongsTo('App\Category');
    }
    public function brand(){
    	return $this->hasOne('App\Brand', 'id', 'brand_id');
    }

    public function images(){
        return $this->belongsToMany('App\Image');
    }    
    // public function quantities(){
    //     return $this->hasMany('App\Quantity', 'quantity_id');
    // }
    public function prices(){
        return $this->hasMany('App\Price');
    }
    public function mrp(){
        return $this->hasOne('App\Mrp');
    }

    public function description(){
        return $this->hasOne('App\Description');
    }

    public function offers(){
        return $this->morphToMany('App\Offer', 'offerable');
    }

}
