<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
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
	public function globalsettings()
	{
	    $globals = DB::table('globalsettings')->get();
	    $settings = [];
	    foreach ($globals as $global) {
	    	$name = $global->name;
	    	$value = $global->value;
	    	$settings[$name] = $value;
	    }
	    return view('admin.globals.settings', compact('settings'));
	}

	public function storesettings(Request $request)
	{
		$settings = $request->all();

		foreach ($settings as $name => $value) {
			DB::table('globalsettings')->where('name', $name)->update(['value'=>$value]);
		}
		return redirect()->route('admin.settings');
	}
}
