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
Route::post('login', 'AuthController@login');

// ESTADOS E CIDADES
Route::get('locations/states', 'LocationsController@states');
Route::get('locations/cities/{id}', 'LocationsController@cities');

Route::group(['middleware'=>'jwt.auth'], function(){
	Route::resource('user', 'UserController');
	Route::resource('address', 'AddressController');
	Route::resource('category', 'CategoryController');
	Route::resource('product', 'ProductController');
	Route::resource('order', 'OrderController');
	Route::resource('delivery', 'DeliveryController');
	Route::resource('store', 'StoreController');
});