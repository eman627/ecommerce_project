<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/auth/login',[UserController::class,"sociallogin"]);
Route::get('/auth/google/redirect',[UserController::class,"redirectToGoogle"]);
Route::get('/google/callback', [UserController::class,"handleGoogleCallback"]);
// Route::get('payment',['App\Http\Controllers\PayPalController','payment'])->name("payment");
