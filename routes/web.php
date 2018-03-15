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
    return view('welcome');
});

/* User */
Route::get('user/show', [
	'as' => 'user.show',
	'uses' => 'UserController@show'
]);

Route::post('user/add', [
	'as' => 'user.add',
	'uses' => 'UserController@add'
]);

Route::get('user/search', [
	'as' => 'user.search',
	'uses' => 'UserController@search'
]);

Route::get('user/delete', [
	'as' => 'user.delete',
	'uses' => 'UserController@delete'
]);

/* Product */
Route::get('product/show', [
	'as' => 'product.show',
	'uses' => 'ProductController@show'
]);

Route::post('product/add', [
	'as' => 'product.add',
	'uses' => 'ProductController@add'
]);

Route::get('product/search', [
	'as' => 'product.search',
	'uses' => 'ProductController@search'
]);

Route::get('product/delete', [
	'as' => 'product.delete',
	'uses' => 'ProductController@delete'
]);