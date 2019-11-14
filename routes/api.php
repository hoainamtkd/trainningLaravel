<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Product
Route::get('products', 'Api\ProductController@getAllProduct');
Route::get('products/{id}', 'Api\ProductController@getProductDetail');

// Slider
Route::get('slider', 'Api\SliderController@getSliderbyPosition'); 