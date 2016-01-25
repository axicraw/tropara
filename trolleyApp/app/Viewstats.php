<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Viewstats extends Model
{
    //
    protected $table = 'viewstats';
    protected $fillable = ['user_id', 'product_id'];
}
