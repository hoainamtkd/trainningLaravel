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
Route::get('related-products/{id}', 'Api\ProductController@getAllRelatedProduct');
Route::get('products/{id}', 'Api\ProductController@getProductDetail');

// Checkout
Route::post('checkout', 'Api\CheckoutController@checkOutOrder');

// Order
Route::get('order/{id}', 'Api\OrderController@getOrderbyId');

// Slider
Route::get('slider', 'Api\SliderController@getSliderbyPosition'); 