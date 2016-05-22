<?php
/**
 * Created by PhpStorm.
 * User: james
 * Date: 5/4/16
 * Time: 11:49 PM
 */

namespace Intersect\Api\Oauth;


use App;
use OAuth2\GrantType\ClientCredentials;
use OAuth2\GrantType\RefreshToken;
use OAuth2\GrantType\UserCredentials;
use OAuth2\Server as Oauth2Server;
use OAuth2\Storage\Pdo as py;

class Server
{
    public static function init()
    {
        ///** OAuth2\Server */
        App::singleton('oauth2' , function ()
        {
            $pdo = DB::connection()->getPdo();
            $storage = new py(array('dsn' => "mysql:dbname=".env('DB_DATABASE')."",'host=localhost' , 'username' => 'root' , 'password' => 'sead2301'));
            $server = new Oauth2Server($storage);

            $server->addGrantType(new ClientCredentials($storage));
            $server->addGrantType(new UserCredentials($storage));
            $server->addGrantType(new RefreshToken($storage,array(
                'always_issue_new_refresh_token' => true
            )));

            return $server;
        });
    }

    public static function getServerInstance()
    {
        return App::make('oauth2');
    }

}