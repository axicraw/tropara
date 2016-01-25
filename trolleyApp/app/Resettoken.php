<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resettoken extends Model
{
    //
    protected $table = 'resettokens';
    protected $fillable = ['user_id', 'token'];

    public function user()
    {
    	return $this->belongsTo('App\User', 'id', 'user_id');
    }
}
