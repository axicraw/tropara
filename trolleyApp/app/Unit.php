<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    //
    protected $table = 'units';
    protected $fillable = ['unit_name', 'shortform'];

    public function prices(){
        return $this->belongsToMany('App\Price');
    }
}
