<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
//->middleware('auth:sanctum')

Route::apiResource('products','App\Http\Controllers\ProductController');
Route::apiResource('categories','App\Http\Controllers\CategoryController');
Route::get('mainCategory',['App\Http\Controllers\CategoryController','mainCategory']);
Route::get('subCategory/{id}',['App\Http\Controllers\CategoryController','subCategory']);
Route::get('product/search/{keyword?}',['App\Http\Controllers\CategoryController','SearchByProductName']);
Route::get('category/filter/{keyword?}',['App\Http\Controllers\CategoryController','filterByCategoryName']);
Route::get('category/search/{keyword?}',['App\Http\Controllers\CategoryController','searchByCategoryName']);
Route::apiResource('orders','App\Http\Controllers\OrderController');
Route::apiResource('offeres','App\Http\Controllers\OfferController');
Route::apiResource('wishlist','App\Http\Controllers\WishlistController');
Route::apiResource('cart','App\Http\Controllers\CartController');
Route::get('totalprice/{id}',['App\Http\Controllers\CartController','calcprice']);
Route::get('totalitem/{id}',['App\Http\Controllers\CartController','totalitem']);
// Route::post('login',['App\Http\Controllers\Auth\LoginController','login']);
// Route::post('register',['App\Http\Controllers\Auth\RegisterController','register']);

Route::put('users/{id}',['App\Http\Controllers\UserController','update']);
Route::get('users',['App\Http\Controllers\UserController','index']);
Route::get('reviews',['App\Http\Controllers\ReviewController','index']);
Route::get('reviews/{id}',['App\Http\Controllers\ReviewController','show']);
Route::post('reviews/{id}',['App\Http\Controllers\ReviewController','store']);
Route::get('countries',['App\Http\Controllers\AddressController','getAllCountries']);
Route::get('states',['App\Http\Controllers\AddressController','getAllStates']);
Route::get('cities/{id}',['App\Http\Controllers\AddressController','getAllCities']);

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');

});
Route::get('payment',['App\Http\Controllers\PayPalController','payment'])->name("payment");
Route::get('payment/cancel',['App\Http\Controllers\PayPalController','cancel'])->name("payment.cancel");
Route::get('payment/success',['App\Http\Controllers\PayPalController','success'])->name("payment.success");
Route::get('stripe',['App\Http\Controllers\StripePaymentController','stripe']);
Route::post('stripe',['App\Http\Controllers\StripePaymentController','stripePost'])->name("stripe.post");






