<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Stock;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Product::where('quantity', 0)->update(['status' => 0]);
        Product::where('quantity','!=',0)->update(['status' => 1]);
        $products = Product::where('user_id', Auth::id())->get();
        return view('admin.product.index',compact('products'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('user_id', Auth::id())->get();
        return view('admin.product.create',compact('categories'));
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
            'product_name' => 'required',
            'category_id' => 'required',
            'unit_price' =>  'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $product = new Product();
        $products = Product::where('product_name', $request->product_name)
                    ->where('user_id', Auth::id())->first();
        if($products == null){
            $product->product_name = $request->product_name;
            $product->category_id = $request->category_id;
            // $product->quantity = $request->quantity;
            // if($request->quantity == 0){
            //     $product->status = 0;
            // }
            $product->unit_price = $request->unit_price;
            $ext = $request->file('image')->getClientOriginalExtension();
            $file = date('YmdHis').rand(1,99999).'.'.$ext;
            $request->file('image')->move(public_path('images'),$file);
            $product->image = $file;
            $product->user_id = Auth::id();
            $product->save();
            return redirect()->route('admin.product.index')->with('message','Product added successfully!');
        }else{
            return redirect()->route('admin.product.create')->with('message','* Product already exists. Update the record');
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
        $arr['categories'] = Category::all();
        $product = Product::find($id);
        return view('admin.product.edit')
            ->with('product_id',$product->id)
            ->with('product_name', $product->product_name)
            ->with('category_id', $product->category_id)
            ->with('quantity',$product->quantity)
            ->with('unit_price',$product->unit_price)
            ->with('image',$product->image)
            ->with($arr);
        
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
            'product_name' => 'required',
            'category_id' => 'required',
            'unit_price' =>  'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048;'
        ]);
        
        $product = Product::find($id);
        $product->product_name = $request->product_name;
        $product->category_id = $request->category_id;
        $product->quantity = $request->quantity + $request->additional_quantity;
        if($product->quantity == 0){
                $product->status = 0;
        }
        else{
            $product->status = 1;
        }
        $product->unit_price = $request->unit_price;
        if($request->file('image')){
            $destination = 'images/'.$product->image;
            if(File::exists($destination)){
                File::delete($destination);
            }
            $request->file('image')->getClientOriginalName();
            $ext = $request->file('image')->getClientOriginalExtension();
            $file = date('Ymd').rand(1,9999).'.'.$ext;
            $request->file('image')->move(public_path('images'),$file);
            $product->image = $file;
        }
        $product->update();
        return redirect()->route('admin.product.index')->with('message','Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $destination = 'images/'.$product->image;
        if(File::exists($destination)){
            File::delete($destination);
        }
        $product->delete();
        return redirect()->route('admin.product.index')->with('message','Product deleted successfully!');
    }
}
