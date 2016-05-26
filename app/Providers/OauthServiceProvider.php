<?php

namespace App\Providers;

use Dingo\Api\Auth\Auth;
use Dingo\Api\Auth\Provider\OAuth2;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;
use Intersect\Api\Oauth\Pdo;
use OAuth2\GrantType\ClientCredentials;
use OAuth2\GrantType\UserCredentials;
use OAuth2\Server;

class OauthServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('oauth', function() {

            $storage = new Pdo($this->app->make('db')->getPdo());
            //$storage = new \OAuth2\Storage\Pdo(App::make('db')->getPdo());
            $server = new Server($storage);

            $server->addGrantType(new ClientCredentials($storage));
            $server->addGrantType(new UserCredentials($storage));
            $server->setConfig('expires_in',898989);

            return $server;
        });
    }
}
