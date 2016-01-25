<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    //
    protected $table = 'offers';
    protected $fillable = ['offer_name', 'start', 'end', 'product_id', 'category_id', 'offer_type', 'amount', 'active'] ;

    public function products()
    {
    	return $this->morphedByMany('App\Product', 'offerable');
    }
    public function categories()
    {
    	return $this->morphedByMany('App\Category', 'offerable');
    }



}
