<?php

namespace App\Http\Controllers;


use App\Models\Category;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Stock;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $date = date('Y-m-d');
        $salecount = Sale::where('date', $date)->where('user_id', Auth::id())->count();
        $todaysale  = Sale::where('date', $date)->where('user_id', Auth::id())->sum('total_price');
        $categories = Category::where('user_id', Auth::id())->count();
        $products = Product::where('user_id', Auth::id())->count();
        $sales = Sale::where('user_id', Auth::id())->count() ;
        $allsales = Sale::where('user_id', Auth::id())->get();
        $total = Sale::where('user_id', Auth::id())->sum('total_price');
        $stock = Product::where('user_id', Auth::id())->sum('quantity');
        $NAproducts = Product::where('status', 0)->where('user_id', Auth::id())->get();
        $allproducts = Product::where('user_id', Auth::id())->orderBy('quantity','ASC')->get();
        return view('admin.dashboard',compact( 'salecount','todaysale','categories', 'products' , 'sales', 'stock','total','allsales','NAproducts','allproducts'));
    }

    //-------display the profile of user----------
    public function showProfile(){
        return view('admin.profile');
    }

    //----------update the user profile--------------
    public function updateProfile(Request $request){
        $request->validate([
            'name' => 'required',
            'username' => 'required'
        ]);
        $user = User::find(Auth::id());
        $user->name = $request->name;
        $user->username = $request->username;
        $user->update();
        return redirect()->back()->with('message','Profile updated successfully!');
    }
    
    //---------Display change password form---------------
    public function pswChange(){
        return view('admin.pswChange');
    }

    //-----------change user password----------
    public function updatePassword(Request $request){
        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        $hashedPassword = Auth::user()->password;
        
        if(Hash::check($request->old_password, $hashedPassword)){
            if(!Hash::check($request->password, $hashedPassword)){
                $user = User::find(Auth::id());
                $user->password = Hash::make($request->password);
                $user->save();
                return redirect()->back()->with('message','Password changed successfully!');
            }
            else{
                return redirect()->back()->with('error','New passsword cannot be the same as old password');
            }
        }
        else{
            return redirect()->back()->with('error','Current password does not match');
        }
    }

}
