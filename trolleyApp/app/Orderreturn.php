<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orderreturn extends Model
{
    //
    protected $table = 'returns';
    protected $fillable = ['name', 'email', 'mobile', 'address', 'reason', 'user_id', 'status'];

    public function order_return()
    {
    	return $this->hasMany('App\Order_Return', 'return_id', 'id');
    }

    public function user()
    {
    	return $this->hasOne('App\User', 'id', 'user_id');
    }

}
