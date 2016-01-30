<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use File;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PlainController extends Controller
{
    public function terms()
    {
        $title = "Terms And Conditions";
        $content = File::get('text/terms.txt');
        return view('site.plain', compact('title', 'content'));

    }
}
