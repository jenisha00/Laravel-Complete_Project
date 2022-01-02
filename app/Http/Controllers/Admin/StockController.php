<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Stock; 
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $arr['stocks'] = Stock::where('user_id', Auth::id())->get();
        return view('admin.stock.index')->with($arr);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::where('user_id', Auth::id())->get();
        return view('admin.stock.create',compact('products'));
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
            'product_id' => 'required',
            'quantity' => 'required|integer',
            'date' => 'required|date'
        ]); 
        
        $stock = new Stock();
        $stock->product_id = $request->product_id;
        $stock->quantity = $request->quantity;
        $stock->date = $request->date;
        $stock->user_id = Auth::id();
        $stock->save();
        DB::table('products')->where('id', $request->product_id)->increment('quantity', $request->quantity);
        return redirect()->route('admin.stock.index')->with('message','Stock added successfully!');
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
        $stock = Stock::where('id', $id)->first();
        return view('admin.stock.edit',compact('products'))
            ->with('id',$stock->id)
            ->with('product_id',$stock->product_id)
            ->with('product_name', $stock->product->product_name)
            ->with('quantity',$stock->quantity)
            ->with('date',$stock->date);
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
            'product_id' => 'required',
            'quantity' => 'required|integer',
            'date' => 'required|date'
        ]); 
        
        $stock = Stock::find($id);
        $stock->product_id = $request->product_id;
        DB::table('products')->where('id', $request->product_id)->decrement('quantity', $stock->quantity);
        $stock->quantity = $request->quantity;
        $stock->date = $request->date;
        $stock->update();
        DB::table('products')->where('id', $request->product_id)->increment('quantity', $request->quantity);
        return redirect()->route('admin.stock.index')->with('message','Stock updated successfully!');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $stock = Stock::find($id);
        $stock->delete();
        return redirect()->route('admin.stock.index')->with('message','Stock deleted successfully!');
    }
}
