<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Search;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
   public function voidsearch()
   {
        $searches = Search::with('user', 'user.area')->get();
        return view('admin.globals.voidsearch', compact('searches'));
   }
}
