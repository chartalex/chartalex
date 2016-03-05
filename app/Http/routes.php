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

	Route::get('/shop', 'ShopController@index');


	Route::get('/cart', 'CartController@cart');
	Route::post('/cart', 'CartController@cart');

	Route::get('/cart/remove', 'CartController@remove');
	Route::get('/cart/destroy', 'CartController@destroy');

	Route::get('robots.txt', function () {
	    if (App::environment() == 'production') {
	        // If on the live server, serve a nice, welcoming robots.txt.
	        Robots::addUserAgent('*');
	        Robots::addSitemap('sitemap.xml');
	    } else {
	        // If you're on any other server, tell everyone to go away.
	        Robots::addDisallow('*');
	    }

	    return Response::make(Robots::generate(), 200, ['Content-Type' => 'text/plain']);
	});

    
});
