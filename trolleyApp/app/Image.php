<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    //
    protected $table = 'images';
    protected $fillable = ['image_name'];

    public function products(){
    	return $this->belongsToMany('App\Product');
    }
}
