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
Route::post('login',['App\Http\Controllers\Auth\LoginController','login']);
Route::post('register',['App\Http\Controllers\Auth\RegisterController','register']);



