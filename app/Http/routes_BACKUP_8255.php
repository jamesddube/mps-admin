<?php

<<<<<<< Updated upstream
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
=======
use Illuminate\Support\Facades\App;


        
     /*   App::singleton('oauth2', function() {

            $storage = new \Intersect\Api\Oauth\Pdo(App::make('db')->getPdo());
            //$storage = new \OAuth2\Storage\Pdo(App::make('db')->getPdo());
            $server = new OAuth2\Server($storage);

            $server->addGrantType(new OAuth2\GrantType\ClientCredentials($storage));
            $server->addGrantType(new OAuth2\GrantType\UserCredentials($storage));

            return $server;
        });*/
        

        
        
        /*
        |--------------------------------------------------------------------------
        | Regular Web Routes
        |--------------------------------------------------------------------------
        |
        | The web interface
        |
        |
        |
        */
        
        // Resource routes...
        Route::get('/','DashboardController@index');
        Route::resource('orders' , 'OrderController');
        Route::resource('products' , 'ProductController');
        Route::resource('customers' , 'CustomerController');
        Route::resource('users' , 'UserController');
        Route::get('salesreps' , 'UserController@salesReps');
        Route::get('salesreps/{id}' , 'UserController@salesRepsShow');
        
        // Authentication routes...
        Route::get('auth/login', 'Auth\AuthController@getLogin');
        Route::post('auth/login', 'Auth\AuthController@postLogin');
        Route::get('auth/logout', 'Auth\AuthController@getLogout');
        
        // Registration routes...
        Route::get('auth/register', 'Auth\AuthController@getRegister');
        Route::post('auth/register', 'Auth\AuthController@postRegister');
        
        Route::get('sales',function(){
        
            return App\vwOrder::sales()->get();
        });
        
        Route::get('email/{email}','EmailController@send');
        Route::post('test',function($id){
>>>>>>> Stashed changes

Route::get('/', function () {
    return view('welcome');
});

<<<<<<< Updated upstream
=======
        $api = app('Dingo\Api\Routing\Router');
        
        $api->version('v1', function ($api)
        {
            $api->post('test',function(\Illuminate\Http\Request $request){
>>>>>>> Stashed changes

$api->version('v1', function ($api)
{
    //Test Api
    $api->get('check',function(){ return ["message" => "success"];});

<<<<<<< Updated upstream
    //Route for API Tokens
    $api->post('oauth/token', 'App\Http\Controllers\Api\OauthController@getToken');
=======
                $api->get('oauth/test',function(){
                   return ['message'=>'authenticated'];
                });

                $api->resource('/orders' , 'App\Http\Controllers\Api\OrderController');
                $api->resource('/users' , 'App\Http\Controllers\Api\UserController');
                $api->resource('/products' , 'App\Http\Controllers\Api\ProductController');
                $api->resource('/customers' , 'App\Http\Controllers\Api\CustomerController');
>>>>>>> Stashed changes

    $api->group(['middleware' => 'oauth'], function($api){

        $api->resource('/orders' , 'App\Http\Controllers\Api\OrderController');
        $api->resource('/users' , 'App\Http\Controllers\Api\UserController');
        $api->resource('/products' , 'App\Http\Controllers\Api\ProductController');
        $api->get('/samples','App\Http\Controllers\Api\SampleController@index');
    });


});