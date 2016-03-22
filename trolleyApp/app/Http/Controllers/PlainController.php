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
        return view('site.terms');

    }
    public function privacy()
    {
        return view('site.privacy');
    }
    public function shipping()
    {
        return view('site.shipping');
    }
}
