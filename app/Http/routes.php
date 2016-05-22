<?php

use Illuminate\Support\Facades\App;
        
        App::singleton('oauth2', function() {
        
            $storage = new \Intersect\Api\Oauth\Pdo(App::make('db')->getPdo());
            //$storage = new \OAuth2\Storage\Pdo(App::make('db')->getPdo());
            $server = new OAuth2\Server($storage);
        
            $server->addGrantType(new OAuth2\GrantType\ClientCredentials($storage));
            $server->addGrantType(new OAuth2\GrantType\UserCredentials($storage));
        
            return $server;
        });
        
        $api = app('Dingo\Api\Routing\Router');
        
        
        
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

           return ['name'=>$id];
        });

        
        
        $api->version('v1', function ($api)
        {
            $api->post('test',function(\Illuminate\Http\Request $request){

                return ['name'=>$request->toArray()];
            });
            $api->get('test','App\Http\Controllers\Api\OrderController@getUpdated');
            //Test Api
            $api->get('check',function(){ return ["message" => "success"];});
        
            //Route for API Tokens
            $api->post('oauth/token', 'App\Http\Controllers\Api\OauthController@getToken');
        
            $api->group(['middleware' => 'oauth'], function($api){

                $api->resource('/orders' , 'App\Http\Controllers\Api\OrderController');
                $api->resource('/users' , 'App\Http\Controllers\Api\UserController');
                $api->resource('/products' , 'App\Http\Controllers\Api\ProductController');
                $api->resource('/customers' , 'App\Http\Controllers\Api\CustomerController');

                $api->get('sync/orders' , 'App\Http\Controllers\Api\OrderController@getUpdated');
                $api->get('sync/users' , 'App\Http\Controllers\Api\UserController@getUpdated');
                $api->get('sync/products' , 'App\Http\Controllers\Api\ProductController@getUpdated');
                $api->get('sync/customers' , 'App\Http\Controllers\Api\CustomerController@getUpdated');
            });

        
        
        });

        Route::group(['prefix'=>'analytics'],function(){

            Route::get('/','AnalyticsController@Dashboard');
        });