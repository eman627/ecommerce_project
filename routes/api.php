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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//->middleware('auth:sanctum')
Route::apiResource('products','App\Http\Controllers\ProductController');
Route::apiResource('categories','App\Http\Controllers\CategoryController');
Route::apiResource('orders','App\Http\Controllers\OrderController');
Route::apiResource('offeres','App\Http\Controllers\OfferController');
Route::apiResource('wishlist','App\Http\Controllers\WishlistController');
Route::apiResource('cart','App\Http\Controllers\CartController');
Route::post('login',['App\Http\Controllers\Auth\LoginController','login']);
Route::post('register',['App\Http\Controllers\Auth\RegisterController','register']);
Route::put('users/{id}',['App\Http\Controllers\UserController','update']);
Route::get('users',['App\Http\Controllers\UserController','index']);
Route::get('reviews',['App\Http\Controllers\ReviewController','index']);
Route::get('reviews/{id}',['App\Http\Controllers\ReviewController','show']);
Route::post('reviews/{id}',['App\Http\Controllers\ReviewController','store']);






