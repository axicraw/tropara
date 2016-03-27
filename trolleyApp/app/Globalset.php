<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Globalset extends Model
{
    //
    protected $table = 'globalsettings';
    protected $fillable = ['name', 'value'];
}
