<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $arr['sales'] = Sale::where('user_id', Auth::id())->get();
        return view('admin.sales.index')->with($arr);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::where('user_id', Auth::id())->get();
        return view('admin.sales.create',compact('products'));
    } 
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product= Product::find($request->product_id);  
        $request->validate([
            'product_id' => 'required',
            'quantity_sold' => 'required|integer|max:'. $product->quantity,
            'unit_price' => 'required|integer',
            'date' => 'required|date',
        ]);    

        $sale = new Sale();
        $sale->product_id = $request->product_id;
        $sale->quantity_sold = $request->quantity_sold;
        $sale->unit_price = $request->unit_price;
        $sale->total_price = $request->quantity_sold * $request->unit_price;
        $sale->date = $request->date;
        $sale->user_id = Auth::id();
        $sale->save();
        DB::table('products')->where('id', $request->product_id)->decrement('quantity', $request->quantity_sold);
        return redirect()->route('admin.sales.index')->with('message','Sale added successfully!');        
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $products = Product::all();
        $sale = Sale::where('id', $id)->first();
        return view('admin.sales.edit',compact('products'))
            ->with('id',$sale->id)
            ->with('product_id',$sale->product_id)
            ->with('product_name', $sale->product->product_name)
            ->with('quantity_sold',$sale->quantity_sold)
            ->with('unit_price',$sale->unit_price)
            ->with('date',$sale->date);
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
        $sale = Sale::find($id);        
        DB::table('products')->where('id', $request->product_id)->increment('quantity', $sale->quantity_sold);
        $product= Product::find($request->product_id);
        $request->validate([
            'product_id' => 'required',
            'quantity_sold' => 'required|integer|max:'. $product->quantity,
            'unit_price' => 'required|integer',
            'date' => 'required|date'
        ]);    

        
        $sale->product_id = $request->product_id;
        $sale->quantity_sold = $request->quantity_sold;
        $sale->unit_price = $request->unit_price;
        $sale->total_price = $request->quantity_sold * $request->unit_price;
        $sale->date = $request->date;
        DB::table('products')->where('id', $request->product_id)->decrement('quantity', $request->quantity_sold);
        $sale->update();
        return redirect()->route('admin.sales.index')->with('message','Sale updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sale = Sale::find($id);
        $sale->delete();
        return redirect()->route('admin.sales.index')->with('message','Sale deleted successfully!');
    }
}
