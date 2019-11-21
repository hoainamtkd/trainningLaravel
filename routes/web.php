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
Route::prefix('admincp')->middleware('auth')->group(function () {
	// Dashboard
	Route::get('dashboard', 'Inside\DashboardController@index')->name('dashboard');
	
	// Product
	Route::get('product', 'Inside\ProductController@getProducts')->name('product');
	Route::get('product/add', 'Inside\ProductController@getAdd')->name('product-add');
	Route::post('product/add', 'Inside\ProductController@postAdd')->name('product-add_post');
	Route::get('product/edit/{id}', 'Inside\ProductController@getEdit')->name('product-edit');
	Route::post('product/edit/{id}/update', 'Inside\ProductController@postEdit')->name('product-update');
	Route::get('product/delete/{id}', 'Inside\ProductController@deleteProduct')->name('product-delete');

	// User
	Route::get('user', 'Inside\UserController@getUser')->name('user');
	Route::get('user/add', 'Inside\UserController@getAdd')->name('user-add');
	Route::get('user/edit/{id}', 'Inside\UserController@getEdit')->name('user-edit');
	Route::post('user/edit/{id}/update', 'Inside\UserController@postEdit')->name('user-edit-post');
	Route::get('user/delete/{id}', 'Inside\UserController@deleteUser')->name('user-delete');

	// Slider
	Route::get('slider', 'Inside\SliderController@index')->name('slider');
	Route::get('slider/add', 'Inside\SliderController@getAdd')->name('slider-add');
	Route::post('slider/add', 'Inside\SliderController@postAdd')->name('slider-add-post');
	Route::get('slider/edit/{id}', 'Inside\SliderController@getEdit')->name('slider-edit');
	Route::post('slider/edit/{id}', 'Inside\SliderController@postEdit')->name('slider-edit-post');
	Route::get('slider/delete/{id}', 'Inside\SliderController@delete')->name('slider-delete');

	// Review
	Route::get('review', 'Inside\ReviewController@index')->name('review'); 
	Route::get('review/approve/{id}', 'Inside\ReviewController@getApprove')->name('review-approve');
	Route::get('review/approve/{id}/unapprove', 'Inside\ReviewController@getUnApprove')->name('review-unapprove');
	Route::get('review/approve/delete/{id}', 'Inside\ReviewController@delete')->name('review-delete'); 

});

// Auth Router
Auth::routes();

// Login , Logout
Route::get('/admincp/login', 'Inside\AuthController@login')->name('login_cp');
Route::get('/admincp/logout', 'Inside\AuthController@logout')->name('logout_cp');

// Fontend
Route::get('/{any}', function ($any) {
	return view('frontend');
})->where('any', '.*');