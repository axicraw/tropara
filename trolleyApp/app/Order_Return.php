<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_Return extends Model
{
    //
    protected $table = 'order_return';
    protected $fillable = ['order_id', 'return_id'];

    public function orders()
    {
    	return $this->hasOne('App\Order', 'id', 'order_id');
    }
}
