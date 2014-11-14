<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

// Backend administration routes
Route::group(array('prefix' => 'administration', 'namespace' => '\Tranquility\Controllers\Backend'), function() {
    // Publically available URLs
    Route::get('/login', 'LoginController@viewLoginForm');
    
    // Restricted routes
    Route::group(array('before' => 'auth'), function() {
        
    });
}); 

// Frontend routes


Route::get('/', function()
{
	return View::make('hello');
});
