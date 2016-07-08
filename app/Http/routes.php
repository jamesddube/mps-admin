<?php


use App\Promotion;

$api = app('Dingo\Api\Routing\Router');

        ;Route::resource('sample','Sample');
        Route::get('promo/{id}',function($id){
           $promo = Promotion::find($id);
          
            return $promo->load('Products');
        });
Route::get('present',function(){
    /** @var \App\vwOrder  $d */
    $d = \App\vwOrder::first();
    //return $d->present()->see;
    //$o = new App\Mps\Presenters\Order();
    return $d->present()->see;
});


        
        
        
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

        // Authentication routes...
        Route::auth();

        Route::group(['middleware' => 'auth'], function() {

            // Resource routes...
            Route::get('/', 'DashboardController@index');
            Route::resource('orders', 'OrderController');
            Route::resource('products', 'ProductController');
            Route::resource('customers', 'CustomerController');
            Route::resource('users', 'UserController');
            Route::get('salesreps', 'UserController@salesReps');
            Route::get('salesreps/{id}', 'UserController@salesRepsShow');


            Route::get('sales', function () {


                return App\vwOrder::sales()->get();
            });

            Route::get('email/{email}', 'EmailController@send');
            Route::get('email', function () {
                return view('emails.send');
            });
        });


        
        
        $api->version('v1', function ($api)
        {

            $api->get('testi',function(\Illuminate\Http\Request $request){

                return response()->json($request->all());
            });
            $api->post('test',function(\Illuminate\Http\Request $request){

                return ['name'=>$request->toArray()];
            });
            $api->get('test','App\Http\Controllers\Api\OrderController@getUpdated');
            //Test Api
            $api->get('check',function(){ return ["message" => "success"];});
        
            //Route for API Tokens
            $api->post('oauth/token', 'App\Http\Controllers\Api\OauthController@getToken');
        
            $api->group(['middleware' => 'oauth'], function($api){
                $api->resource('sample','App\Http\Controllers\Sample');

                $api->resource('/orders' , 'App\Http\Controllers\Api\OrderController');
                $api->resource('/users' , 'App\Http\Controllers\Api\UserController');
                $api->resource('/products' , 'App\Http\Controllers\Api\ProductController');
                $api->resource('/customers' , 'App\Http\Controllers\Api\CustomerController');

                $api->any('sync','App\Http\Controllers\Api\SyncController@hardSync');

                $api->get('sync/orders' , 'App\Http\Controllers\Api\OrderController@sync');
                $api->get('sync/users' , 'App\Http\Controllers\Api\UserController@getUpdated');
                $api->get('sync/products' , 'App\Http\Controllers\Api\ProductController@getUpdated');
                $api->get('sync/customers' , 'App\Http\Controllers\Api\CustomerController@getUpdated');
            });

        
        
        });

        Route::group(['prefix'=>'analytics'],function(){

            Route::get('/','AnalyticsController@Dashboard');
        });

        Route::get('protected',function()
        {
           return response()->json([
               'message' => 'forbidden resource',
               'description' => 'you are not allowed to view this resource'
           ],401);
        });