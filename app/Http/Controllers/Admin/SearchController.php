<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    //--------checks whether user is authenticated---------------
    public function __construct()
    {
        $this->middleware('auth');
    }

    //---------display search form----------------
    public function showSearchForm(){
        return view('admin.search');
    }

    //----------takes product name as input and returns all the recordss of the products-----------
    public function submitSearchForm(Request $request){
        $request->validate([
            'product_name'  => 'required'
        ]);

        //------check whether products already exits or not------------
        $search = Product::where('product_name', $request->product_name)
                    ->where('user_id', Auth::id())->first();
        if($search == null){
            return back()->with('message','Product does not exist');
        }
        else{
            $sale = Sale::where('product_id',$search->id)
                    ->where('user_id', Auth::id())->first();
            if($sale == null){
                return view('admin.search')
                ->with('product_name', $search->product_name)
                ->with('category_name', $search->category->category_name)
                ->with('quantity', $search->quantity)
                ->with('unit_price', $search->unit_price)
                ->with('status',$search->status);
            }
            else{
                /* $search = Product::join('sales', 'products.id' , '=', 'sales.product_id')
                         ->where('product_name',$request->product_name)
                        ->get(['products.*', 'sales.quantity_sold', 'sales.quantity_available', 'sales.total_price','sales.unit_price']);            
                 return view('admin.search',compact('search'));*/

                $search = Product::select('products.id', 'products.product_name','products.category_id', 'products.quantity','products.status',DB::raw('SUM(sales.quantity_sold) as quantity_sold') , DB::raw('SUM(sales.total_price) as total_price'),'sales.unit_price')
                        ->join('sales', 'products.id' , '=', 'sales.product_id')
                        ->where('product_name',$request->product_name)
                        ->where('products.user_id',Auth::id())
                        ->groupBy('products.id', 'products.product_name','products.category_id','products.quantity','products.status','sales.unit_price')
                        ->get();
                    
                return view('admin.search',compact('search'));                  
            }
           
        }
    }
}

