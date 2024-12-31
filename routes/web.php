<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\watchlist;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\WatchlistController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});
Route::view( '/login','login')->name('login');

Route::view( '/','index')->name('index');

Route::view('/shop','shop')->name('shop');

Route::view('/about','about')->name('about');

Route::view('/service','service')->name('service');

Route::view('/contact','contact')->name('contact');

Route::view('/cart','cart')->name('cart');

Route::view('/checkout','checkout')->name('checkout');

Route::view('/thankyou','thankyou')->name('thankyou');

Route::view('/blog','blog')->name('blog');

//Route::view('/watchlist','watchlist')->name('watchlist');

Route::resource('client',ClientController::class);

Route::resource('category',CategoryController::class);

Route::post('/login_check',[LoginController::class,'login']);

Route::view('/dashboard','dashboard');

Route::resource('product',ProductController::class);

Route::post('/client/watchlist/{id}', [WatchlistController::class,'add'])->name('watchlist.add');

Route::post('/client/cart/{id}', [CartController::class,'add'])->name('cart.add');

Route::get('/watchlist', [WatchlistController::class,'index'])->name('wishlist.index');

Route::delete('/wishlist/remove/{id}', [WatchlistController::class,'remove'])->name('wishlist.remove');

Route::delete('/cart/remove/{id}', [CartController::class,'remove'])->name('cart.remove');

route::get('/logout',[ClientController::class,'logout'])->name('logout');

Route::resource('cart',CartController::class);

Route::resource('order',OrderController::class);

Route::get('/orders',[OrderController::class,'order'])->name('client.order');