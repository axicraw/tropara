<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tempcart extends Model
{
    //
    protected $table="tempcart";
    protected $fillable = ['user_id', 'product_id', 'pqty_id', 'nos'];
   

}
