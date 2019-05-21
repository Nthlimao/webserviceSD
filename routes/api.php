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
// ACCOUNT
Route::group(['middleware' => 'jwt.auth'], function ($api) {
	Route::get('account/profile', 'AccountController@view');
	Route::put('account/profile', 'AccountController@update');
	Route::resource('account/address', 'AccountAddressesController');
});

// AUTH
Route::post('login', 'AuthController@login');

// ESTADOS E CIDADES
Route::get('locations/states', 'LocationsController@states');
Route::get('locations/cities/{id}', 'LocationsController@cities');

// CATEGORIAS
Route::resource('category', 'CategoryController')->only(['store', 'update', 'destroy'])->middleware(['jwt.auth', 'is.admin']);
Route::get('category', 'CategoryController@index');
Route::get('category/{id}', 'CategoryController@show');

// PRODUTOS
Route::resource('product', 'ProductController')->only(['update', 'store', 'destroy'])->middleware(['jwt.auth', 'is.admin']);
Route::get('product', 'ProductController@index');
Route::get('product/{id}', 'ProductController@show');

// PEDIDOS
Route::resource('order', 'OrderController')->only(['update', 'index', 'destroy'])->middleware(['jwt.auth', 'is.admin']);
Route::post('order', 'OrderController@store')->middleware(['jwt.auth']);
Route::get('order/{id}', 'OrderController@show')->middleware(['jwt.auth']);

// ENTREGAS E RETIRADAS
Route::resource('delivery', 'DeliveryController')->middleware(['jwt.auth', 'is.admin']);
Route::resource('store', 'StoreController')->middleware(['jwt.auth', 'is.admin']);

// USUARIOS E ENDEREÇOS
Route::resource('user', 'UserController')->middleware(['jwt.auth', 'is.admin']);
Route::resource('address', 'AddressController')->middleware(['jwt.auth', 'is.admin']);