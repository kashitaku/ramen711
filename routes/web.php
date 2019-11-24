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
    return view('shop.index');
});

Auth::routes();

//twitter login
Route::get('/login/twitter', 'Auth\LoginController@redirectToProvider')->name('twitter.login');
Route::get('/login/twitter/callback', 'Auth\LoginController@handleProviderCallback');
Route::get('auth/twitter/logout', 'Auth\TwitterController@logout');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'ShopController@index')->name('shop.index');
Route::get('/shop/detail/{id}', 'ShopController@detail')->name('shop.detail');
Route::post('/shop/like/{shop}',  'LikesController@store')->name('shop.like.store');
Route::post('/shop/like/{shop}/{like}',  'LikesController@destroy')->name('shop.like.destroy');

Route::get('/user/', 'UserController@index')->name('user.index');
Route::get('/user/detail/{id}', 'UserController@detail')->name('user.detail');
Route::get('/user/edit/{id}', 'UserController@edit')->name('user.edit');
Route::post('/user/edit/{id}', 'UserController@update')->name('user.update');

Route::post('/shop/review/{id}', 'ReviewsController@store')->name('shop.review');
Route::post('/shop/review/delete/{id}/{shopId}', 'ReviewsController@delete')->name('shop.review.delete');

Route::prefix('admin')->group(function() {
	Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
	Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
	Route::get('/', 'AdminController@index')->name('admin.index');
	Route::get('/shop/detail/{id}', 'AdminController@detail')->name('admin.shop.detail');
	Route::get('/shop/add', 'AdminController@add')->name('admin.shop.add');
	Route::post('/shop/add', 'AdminController@create')->name('admin.shop.create');
	Route::get('/shop/edit/{id}', 'AdminController@edit')->name('admin.shop.edit');
	Route::post('/shop/edit/{id}', 'AdminController@update')->name('admin.shop.update');
	Route::post('/shop/delete/{id}', 'AdminController@delete')->name('admin.shop.delete');
	Route::post('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
});

