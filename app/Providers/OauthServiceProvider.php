<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class OauthServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton('oauth', function() {

            $storage = new \App\Intersect\Api\Oauth\Pdo($this->app->make('db')->getPdo());
            //$storage = new \OAuth2\Storage\Pdo(App::make('db')->getPdo());
            $server = new \OAuth2\Server($storage);

            $server->addGrantType(new \OAuth2\GrantType\ClientCredentials($storage));
            $server->addGrantType(new \OAuth2\GrantType\UserCredentials($storage));
            $server->addGrantType(new \OAuth2\GrantType\RefreshToken($storage, array(
                                    'always_issue_new_refresh_token' => true
                                )));

            return $server;
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
