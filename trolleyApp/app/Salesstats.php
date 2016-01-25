<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salesstats extends Model
{
    //
    protected $table = 'salesstats';
    protected $fillable = ['user_id', 'product_id'];
}
