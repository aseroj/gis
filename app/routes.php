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

/** ------------------------------------------
*  Errors !
*  ------------------------------------------
*/
// App::missing(function($exception) {
//     return Response::view('errors.missing', array(), 404);
// });

/** ------------------------------------------
*  Admin Routes
*  ------------------------------------------
*/
// Route::controller('/users', 'UsersAdminController');

/** ------------------------------------------
*  Frontend Routes
*  ------------------------------------------
*/
Route::any('/', 'HomeController@showWelcome');
Route::controller('/air', 'AirController');
