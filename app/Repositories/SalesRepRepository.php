<?php
/**
 * Created by PhpStorm.
 * User: rick
 * Date: 5/22/16
 * Time: 1:58 PM
 */

namespace App\Repositories;


use App\SalesRep;
use App\User;
use App\vwUser;

class SalesRepRepository
{

    public static function all($columns = ['*'])
    {
        return $users =  vwUser::reps()->get();
    }

    public static function show($id)
    {
        /** @var SalesRep $user */
        $user =  SalesRep::show($id);
        
        return $user->load('orders');
    }
}