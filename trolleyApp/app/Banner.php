<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    //

    protected $table = 'banners';
    protected $fillable = ['title', 'caption', 'image_id', 'location_id'];

    public function image(){
    	return $this->hasOne('App\Image', 'id', 'image_id');
    }
}
