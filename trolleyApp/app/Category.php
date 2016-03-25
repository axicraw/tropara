<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $table = "categories";
    protected $fillable = ['category_name', 'parent_id', 'level', 'did'];

    public function parent(){
    	return $this->belongsTo('App\Category', 'parent_id');
    }
    public function children(){
    	return $this->hasMany('App\Category', 'parent_id');
    }
    public function products(){
    	return $this->hasMany('App\Product', 'category_id', 'id');
    }
    
    public function offers(){
        return $this->morphToMany('App\Offer', 'offerable');
    }
}
