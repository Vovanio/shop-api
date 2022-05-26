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

Route::get('products', 'App\Http\Controllers\ProductsController@index');

Route::middleware('auth.check:api')->group(function (){
    Route::post('products/add', 'App\Http\Controllers\ProductsController@store');
    Route::post('products/update', 'App\Http\Controllers\ProductsController@update');
    Route::post('products/delete', 'App\Http\Controllers\ProductsController@destroy');
    Route::post('email/send', 'App\Http\Controllers\MailController@SendMail');
});

Route::post('admin/login', 'App\Http\Controllers\AuthController@Login');




