<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Banner;
use App\Image;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class BannersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $banners = Banner::with('image')->get();
        return view('admin/banner/banner', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.banner.create');
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
            'title' => 'required',
            'caption' => 'required',
            'image' => 'required'
        ]);

        $input = $request->all();
        $banner = Banner::create($input);
        $banner->location_id = 1;

        $image = $request->file('image');

        //dd($request->all());

        //saving image
        $image_name = $image->getClientOriginalName();
        $image->move(public_path().'/images/banners/', $image_name);
        $newImage = Image::create(['image_name'=>$image_name]);

        //attach image to banner
        $banner->image_id = $newImage->id;

        $banner->save();
        return redirect()->route('admin.banner.index');
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
        $banner = Banner::findOrFail($id);
        return view('admin.banner.edit', compact('banner'));
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
            'title' => 'required',
            'caption' => 'required',
        ]);

        $input = $request->all();
        $banner = Banner::findOrFail($id);
        $banner->fill($input);
        //dd($request->all());
        if($request->hasFile('image')){
            Image::destroy($banner->image_id);
            $image = $request->file('image');
            $image_name = $image->getClientOriginalName();
            $image->move(public_path().'/images/banners/', $image_name);
            $newImage = Image::create(['image_name'=>$image_name]);
            $banner->image_id = $newImage->id;
        }       

        $banner->save();
        return redirect()->route('admin.banner.index');
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
        Banner::destroy($id);
        return redirect()->route('admin.banner.index');
    }
}
