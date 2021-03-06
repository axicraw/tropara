<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\User;
use App\Category;
use App\Product;
use App\Area;
use App\Order;
use App\Globalset;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ApanelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::select('id')->get();
        $products = Product::select('id')->get();
        $categories = Category::select('id')->get();
        $areas = Area::select('id')->get();
        $orders = Order::select('id')->get();
        return view('admin.dashboard', compact('users', 'products', 'categories', 'areas', 'orders'));
    }

    public function changeMaintenanceMode(Request $request){
        $mode = $request->get('maintenance');
        if($mode === 'on'){
           $global = Globalset::where('name', 'maintenance')->firstorfail();
           $global->value = 'on';
           $global->save();

        }
        elseif($mode === 'off'){
            $global = Globalset::where('name', 'maintenance')->firstorfail();
           $global->value = 'off';
           $global->save();
        }
        else{
            return response()->json('error');
        }

        return response()->json('success');
    }
    public function getMaintenanceMode(){
            $global = Globalset::where('name', 'maintenance')->firstorfail();
            $value = $global->value;
        return response()->json($value);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
