<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Carbon\Carbon;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class DeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $dts = DB::table('deliverytimes')->get();

        foreach ($dts as $dt) {
            $dt->start =Carbon::parse($dt->start)->format('h:ia');
            $dt->stop = Carbon::parse($dt->stop)->format('h:ia');
        }

        return view('admin.deliverytime.deliverytime', compact('dts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.deliverytime.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $this->validate($request, [
            'start'=>'required',
            'stop'=>'required',
            'name'=>'required'
        ]);
        $start = Carbon::createFromFormat('h:ia', $request->start);
        $stop = Carbon::createFromFormat('h:ia', $request->stop);

      //  dd($start);
        DB::table('deliverytimes')->insert([
            'name' => $request->name,
            'start' => $start,
            'stop' => $stop,
            'active' => $request->active
        ]);

        return redirect()->route('admin.delivery.index');
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
        $dt = DB::table('deliverytimes')->where('id', $id)->first();
        //dd($dt);
        $dt->start = Carbon::parse($dt->start)->format('h:ia');
        $dt->stop = Carbon::parse($dt->stop)->format('h:ia');
        return view('admin.deliverytime.edit', compact('dt'));
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
          $this->validate($request, [
              'start'=>'required',
              'stop'=>'required',
              'name'=>'required'
          ]);
          $start = Carbon::createFromFormat('h:ia', $request->start);
          $stop = Carbon::createFromFormat('h:ia', $request->stop);
          //dd($stop);
          if($request->has('active')){
                $active = $request->active;
          }else{
                $active->active = 0;
          }

        //dd($start, $stop, $request->name, $active);
          $update = DB::table('deliverytimes')->where('id', $id)->update([
              'name' => $request->name,
              'start' => $start,
              'stop' => $stop,
              'active' => $active
          ]);
          //dd($update);
          return redirect()->route('admin.delivery.index');
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
        DB::table('deliverytimes')->where('id', $id)->delete();
        return redirect()->route('admin.delivery.index');
    }
}
