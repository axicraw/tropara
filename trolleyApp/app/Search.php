<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Search extends Model
{
    //
    protected $table='voidsearches';
    protected $fillable = ['user_id', 'keyword'];

    public function user()
    {
    	return $this->hasOne('App\User', 'id', 'user_id');
    }
}
