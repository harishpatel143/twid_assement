<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

//Get Listing in frontend
$router->get('/', 'PinCodeController@index');
$router->get('/list', 'PinCodeController@anyData');

//Fetch data from URL
$router->post('/', 'PinCodeController@fetchDetailsUsingCommand');
$router->post('/job-fetch', 'PinCodeController@fetchDetailsUsingJob');
