<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categories = Category::where('parent_id',0)->with('children')->get();
        return view('admin/category/category', compact('categories'));
    }
    public function getall()
    {
        $categories = Category::where('parent_id',0)->with('children')->get();
        return response()->json($categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
       $categories = Category::get();
        return view('admin/category/create', compact('categories'));
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
        $this->validate($request,[
            'category_name'=>'required|unique:categories'
        ]);
        $level = 0;
        $parent_id = 0;
         if($request->has('parent_id')){
            $parent_id = $request->get('parent_id');
        }
        // if($parent_id){
        //     $parent_cate = Category::find($parent_id);
        //     $level = $parent_cate->level;
        // }
        $new_catgory = [
            'category_name' => $request->category_name,
            'parent_id' => $parent_id,
            'level'=> 0
        ];
        $category = Category::create($new_catgory);
        return redirect()->route('admin.category.index');
    }
    public function add(Request $request)
    {
        //
        $this->validate($request,[
            'category_name'=>'required|unique:categories'
        ]);
        $parent_id = 0;
        if($request->has('parent_id')){
            $parent_id = $request->get('parent_id');
        }
        // if($parent_id){
        //     $parent_cate = Category::find($parent_id);
        //     $level = $parent_cate->level;
        // }
        $new_catgory = [
            'category_name' => $request->category_name,
            'parent_id' => $parent_id,
            'level'=> 0
        ];
        $category = Category::create($new_catgory);
        return response()->json($category);
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
        $currCategory = Category::find($id);
        $categories = Category::get();
        return view('admin.category.edit', compact('currCategory', 'categories'));
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
        $this->validate($request,[
            'category_name'=>'required|unique:categories,category_name,'.$id
        ]);
        $category = Category::find($id);
        $category->category_name = $request->category_name;
        $category->parent_id = $request->parent_id;
        $category->save();
        return redirect()->route('admin.category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       Category::destroy($id);
       return redirect()->route('admin.category.index');
    }
}
