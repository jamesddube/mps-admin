<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
$api = app('Dingo\Api\Routing\Router');

Route::get('/', function () {
    return view('welcome');
});


$api->version('v1', function ($api)
{
    //Test Api
    $api->get('check',function(){ return ["message" => "success"];});

    //Route for API Tokens
    $api->post('oauth/token', 'App\Http\Controllers\Api\OauthController@getToken');

    $api->group(['middleware' => 'oauth'], function($api){

        $api->resource('/orders' , 'App\Http\Controllers\Api\OrderController');
        $api->resource('/users' , 'App\Http\Controllers\Api\UserController');
        $api->resource('/products' , 'App\Http\Controllers\Api\ProductController');
        $api->get('/samples','App\Http\Controllers\Api\SampleController@index');
    });


});