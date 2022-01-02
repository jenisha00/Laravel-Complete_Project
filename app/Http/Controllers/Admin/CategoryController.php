<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $arr['categories'] = Category::where('user_id', Auth::id())->get();
        return view('admin.category.index')->with($arr);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required'
        ]);

        $category = new Category();
        $categories = Category::where('category_name', $request->category_name)
                    ->where('user_id', Auth::id())->first();
        if($categories == null){
            $category->category_name = $request->category_name;
            $category->user_id = Auth::id();
            $category->save();
            return redirect()->route('admin.category.index')->with('message','Category added successfully!');
        }
        else{
            return redirect()->route('admin.category.create')->with('message','* Category already exists');
        }        
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.category.edit')
            ->with('category_id', $category->id)
            ->with('category_name', $category->category_name);
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
        $request->validate([
            'category_name' => 'required'
        ]);

        $category = Category::find($id);
        $category->category_name = $request->category_name;
        $category->update();
        return redirect()->route('admin.category.index')->with('message','Category updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect()->route('admin.category.index')->with('message','Category deleted successfully!');
    }
}
