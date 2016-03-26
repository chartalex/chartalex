<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/



/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    
	Route::get('/', 'IndexController@index');

	Route::get('/mclh', 'ShopController@index');


	Route::get('/mclh/cart', 'CartController@cart');
	Route::post('/mclh/cart', 'CartController@cart');

	Route::get('/mclh/cart/remove', 'CartController@remove');
	Route::get('/mclh/cart/destroy', 'CartController@destroy');

	Route::get('/mclh/order-success', function () {
		return View::make('mclh.order-success');
	});

	Route::get('/mclh/terms', function () {
		return View::make('mclh.terms');
	});


	Route::resource('/mclh/order', 'OrderController');
	//Route::resource('/mclh/order', 'OrderController', [
	//   	'only' => ['store', 'show']
	   	//    'except' => ['edit', 'create']
	//]);


    // Only authenticated users may enter...
	//Route::get('/mclh/order', [
    //	'middleware' => 'auth',
    //	'uses' => 'OrderController@index'
	//]);

	Route::get('posts/{title}', function ($title) {
		return View::make('posts.'.$title);
	});

	// Authentication routes...
	Route::get('auth/login', 'Auth\AuthController@getLogin');
	Route::post('auth/login', 'Auth\AuthController@postLogin');
	Route::get('auth/logout', 'Auth\AuthController@getLogout');

	Route::get('auth/email-sent', function () {
		return View::make('auth.email-sent');
	});


	Route::get('auth/email-authenticate/{token}', [
	    'as' => 'auth.email-authenticate',
	    'uses' => 'Auth\AuthController@authenticateEmail'
	]);

	// Registration routes...
	//Route::get('auth/register', 'Auth\AuthController@getRegister');
	//Route::post('auth/register', 'Auth\AuthController@postRegister');
});
