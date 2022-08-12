<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use \App\Http\Controllers\UserController;


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

//  Route::post('orders','OrderController@store');

//API For Product
Route::apiResource('products','App\Http\Controllers\ProductController');
// producterbyuser
//API For Category
Route::get('producterbyuser/{id}',['App\Http\Controllers\ProductController','producterbyuser']);
Route::apiResource('categories','App\Http\Controllers\CategoryController');
Route::get('mainCategory',['App\Http\Controllers\CategoryController','mainCategory']);
Route::get('subCategory/{id}',['App\Http\Controllers\CategoryController','subCategory']);

//API For Orders && Offers && Wishlistes
Route::apiResource('orders','App\Http\Controllers\OrderController');
Route::get('order/{id}',['App\Http\Controllers\OrderController','showorderofuser']);
Route::apiResource('offeres','App\Http\Controllers\OfferController');
Route::apiResource('wishlist','App\Http\Controllers\WishlistController');

//API Cart
Route::apiResource('cart','App\Http\Controllers\CartController');
Route::get('totalprice/{id}',['App\Http\Controllers\CartController','calcprice']);
Route::get('totalitem/{id}',['App\Http\Controllers\CartController','totalitem']);

//API For Filter && Search
Route::get('product/search/{keyword?}',['App\Http\Controllers\FilterControler','SearchByProductName']);
Route::get('category/filter/{keyword?}',['App\Http\Controllers\FilterControler','filterByCategoryName']);
Route::get('category/search/{keyword?}',['App\Http\Controllers\FilterControler','searchByCategoryName']);
Route::post('brand/filter',['App\Http\Controllers\FilterControler','filterByBrandName']);

// API for offers filtered
Route::get('productOffered',['App\Http\Controllers\OfferController','productOffered']);
Route::get('endAtTheSameTime',['App\Http\Controllers\OfferController','endAtTheSameTime']);


//API for User
Route::put('users/{id}',['App\Http\Controllers\UserController','update']);
Route::get('users',['App\Http\Controllers\UserController','index']);
Route::post('changepassword/{id}',['App\Http\Controllers\UserController','ChangePassword']);


//API for Reviwes
Route::get('reviews',['App\Http\Controllers\ReviewController','index']);
Route::get('reviews/{id}',['App\Http\Controllers\ReviewController','show']);
Route::get('review/{id}',['App\Http\Controllers\ReviewController','getProductToReviwe']);
Route::post('reviews/{id}',['App\Http\Controllers\ReviewController','store']);

//API for Addresses
Route::get('countries',['App\Http\Controllers\AddressController','getAllCountries']);
Route::get('states',['App\Http\Controllers\AddressController','getAllStates']);
Route::get('cities/{id}',['App\Http\Controllers\AddressController','getAllCities']);



//API Auth

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login')->name('login');
    Route::post('verifyAccount','verifyAccount')->name('verifyAccount');
    Route::post('forgetpassword','forgetpassword')->name('forgetpassword');
    Route::post('updatepassword/{id}','updatepassword')->name('updatepassword');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');

});



//API For Payment Method
Route::get('payment',['App\Http\Controllers\PayPalController','payment'])->name("payment");
Route::get('payment/cancel',['App\Http\Controllers\PayPalController','cancel'])->name("payment.cancel");
Route::get('payment/success',['App\Http\Controllers\PayPalController','success'])->name("payment.success");
Route::get('stripe',['App\Http\Controllers\StripePaymentController','stripe']);
Route::post('stripe',['App\Http\Controllers\StripePaymentController','stripePost'])->name("stripe.post");

//API For Social Login
Route::get('/login/{provider}', [AuthController::class,'redirectToProvider']);
Route::get('/login/{provider}/callback', [AuthController::class,'handleProviderCallback']);






