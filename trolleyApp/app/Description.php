<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Description extends Model
{
    //
    protected $table = 'descriptions';
    protected $fillable = ['description', 'product_id'];

    public function product(){
    	return $this->belongsTo('App\Product', 'id', 'product_id');
    }
}
