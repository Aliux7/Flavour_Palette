<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/', [UserController::class, 'index'])->name("home");
// Route::get('/gamedetail/{id}',[GameController::class, 'gameDetail']);
// Route::get('/search', [GameController::class, 'search']);
// Route::post('/addcart', [CartController::class, 'addcart']);

Route::group(['middleware' => 'guest'], function(){
    Route::get('/login', [UserController::class, 'login'])->name("login");
    Route::post('/login', [UserController::class, 'loginAuth']);
    Route::get('/register', [UserController::class, 'register']);
    Route::post('/register', [UserController::class, 'registerAuth']);
});
