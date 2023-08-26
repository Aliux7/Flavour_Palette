<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ManageController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Route;

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
Route::get('/', [MenuController::class, 'home'])->name("home");
// Route::get('/search', [MenuController::class, 'search']);
Route::get('/catalog', [MenuController::class, 'catalog'])->name("catalog");
Route::get('/menudetail/{id}',[MenuController::class, 'menuDetail']);
Route::get('/sort',[MenuController::class, 'sort']);


Route::group(['middleware' => 'guest'], function(){
    Route::get('/login', [UserController::class, 'login'])->name("login");
    Route::post('/login', [UserController::class, 'loginAuth']);
    Route::get('/register', [UserController::class, 'registerCustomer'])->name("tab_customer");
    Route::post('/register', [UserController::class, 'registerAuthCustomer'])->name("authCustomer");
    Route::post('/register/catering', [UserController::class, 'registerAuthCatering'])->name("authCatering");
});

Route::group(['middleware' => 'auth'], function(){
    Route::get('/logout', [UserController::class, 'logout']);
    Route::get('/profile', [UserController::class, 'profile']);
    Route::post('/updateprofile', [UserController::class, 'updateprofile']);
    Route::post('/updatepassword', [UserController::class, 'updatepassword']);
    Route::get('/orderdetail/{id}',[ManageController::class, 'orderdetail']);

    Route::group(['middleware'=>'customer'], function(){
        Route::get('/cart', [CartController::class, 'cart']);
        Route::post('/cart/update', [CartController::class, 'updateQuantity']);
        Route::post('/addcart', [CartController::class, 'addcart']);
        Route::post('/checkout', [CartController::class, 'checkout']);
        Route::get('/wishlist', [WishlistController::class, 'wishlist']);
        Route::post('/updatewishlist', [WishlistController::class, 'updatewishlist']);
        Route::get('/orderhistory', [ManageController::class, 'orderhistory']);
        Route::get('/delivery', [CartController::class, 'delivery']);
    });

    Route::group(['middleware'=>'seller'], function(){
        Route::post('/updatecatering', [UserController::class, 'updatecatering']);
        Route::post('/updatemenu', [MenuController::class, 'updatemenu']);
        Route::get('/manageorder', [ManageController::class, 'manageorder']);
    });
});

