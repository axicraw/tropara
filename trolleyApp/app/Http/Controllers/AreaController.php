<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Area;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $areas = Area::all();
        return view('admin.area.area', compact('areas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.area.create');
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
        $this->validate($request, [
            'area_name' => 'required',
            'delivery_cost' => 'numeric'
        ]);
        $input = $request->all();
        //dd($input);
        $input['city_id'] = 1;
        $area = Area::create($input);
        $area->save();
        return redirect()->route('admin.area.index');
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
        $area = Area::findOrFail($id);
        return view('admin.area.edit', compact('area'));
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
            'area_name' => 'required'
        ]);
        $area = Area::findOrFail($id);
        $input = $request->all();
        $input['city_id'] = 1;
        $area->fill($input);
        if(!$request->has('deliverable')){
            $area->deliverable = 0;
        }
        $area->save();
        return redirect()->route('admin.area.index');
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
        Area::destroy($id);
        return redirect()->route('admin.area.index');
    }
}
