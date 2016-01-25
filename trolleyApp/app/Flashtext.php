<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flashtext extends Model
{
    //

    protected $table = "flashtext";
    protected $fillable = ['text', 'active'];
}
