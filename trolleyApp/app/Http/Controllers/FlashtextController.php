<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Flashtext;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class FlashtextController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $flashtext = Flashtext::all();
        return view('admin.flashtext.flashtext', compact('flashtext'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.flashtext.create');
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
            'text' => 'required'
        ]);
        //dd($request->all());
        $flash = Flashtext::create($request->all());
        return redirect()->route('admin.flashtext.index');

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
        $flash = Flashtext::findOrFail($id);
        return view('admin.flashtext.edit', compact('flash'));
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
            'text' => 'required'
        ]);
        $flash = Flashtext::findOrFail($id);
        $flash->fill($request->all());
        if(!$request->has('active')){
            $flash->active = 0;
        }
        $flash->save();

        return redirect()->route('admin.flashtext.index');
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
        Flashtext::destroy($id);
        return redirect()->route('admin.flashtext.index');
    }
}
