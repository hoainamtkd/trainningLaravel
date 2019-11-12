<?php

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
    return view('frontend');
});

/*
|--------------------------------------------------------------------------
| BackEnd
|--------------------------------------------------------------------------
*/
Route::prefix('cpanel')->group(function () {
	Route::get('product', 'Inside\ProductController@getProducts')->name('product');
	Route::get('product/add', 'Inside\ProductController@getAdd')->name('product-add');
	Route::post('product/add', 'Inside\ProductController@postAdd')->name('product-add_post');
	Route::get('product/edit/{id}', 'Inside\ProductController@getEdit')->name('product-edit');
	Route::post('product/edit/{id}/update', 'Inside\ProductController@postEdit')->name('product-update');
	Route::get('product/delete/{id}', 'Inside\ProductController@deleteProduct')->name('product-delete');
});