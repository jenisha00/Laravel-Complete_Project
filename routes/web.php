<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\SearchController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//---------Login Route--------------
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');

Auth::routes();

//-------Dashboard Route-----------
Route::group(['middleware'=>'disable_back_btn'],function () {
    Route::get('/ims', [DashboardController::class, 'index'])->name('dashboard');
    Route::namespace('App\Http\Controllers\Admin')->prefix('ims')->as('admin.')->middleware('auth')->group(function(){
                    Route::resource('/category', CategoryController::class);
                    Route::resource('/product', ProductController::class);
                    Route::resource('/sales', SalesController::class);
                    Route::resource('/stock', StockController::class);                    
    });
                                
    Route::get('/ims/search',[SearchController::class,'showSearchForm'])->name('showForm');
    Route::post('/ims/search',[SearchController::class,'submitSearchForm'])->name('submitForm');
    Route::get('/ims/profile',[DashboardController::class,'showProfile'])->name('showProfile'); 
    Route::put('/ims/profile',[DashboardController::class,'updateProfile'])->name('updateProfile');   
    Route::get('/ims/pswchange',[DashboardController::class,'pswChange'])->name('pswChange');
    Route::put('/ims/pswchange',[DashboardController::class,'updatePassword'])->name('updatePassword');
});