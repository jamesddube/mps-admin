<?php
/**
 * Created by PhpStorm.
 * User: james
 * Date: 5/5/16
 * Time: 7:26 PM
 */

namespace Intersect\Api\Oauth;


use OAuth2\Storage\Pdo as Oauth2Pdo;
use Illuminate\Support\Facades\Auth;
class Pdo extends Oauth2Pdo
{
    public function __construct($connection, $config = array())
    {
        parent::__construct($connection , $config);

        //Set custom table
        $config['user_table'] = 'users';
    }

    public function checkUserCredentials($username , $password)
    {


        if(Auth::validate(array('email' => $username, 'password' => $password)))
        {
            return true;
        }

        return false;
    }

    public function getUser($username)
    {
        if(!$user = \App\User::where('email',$username)->first()->toArray())
        {
            return false;
        }
        return array_merge(['user_id' => $username],$user);
    }


}