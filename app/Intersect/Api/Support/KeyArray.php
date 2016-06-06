<?php
/**
 * Created by PhpStorm.
 * User: james
 * Date: 12/1/15
 * Time: 4:28 PM
 */

namespace App\Intersect\Api\Support;


use Illuminate\Support\Collection;

class KeyArray
{

    public static function getArray($array , $key)
    {
        $collection = Collection::make($array);

        $id = $collection->map(function($od)use ($key){
            return $od[$key];
        });

        return $id->flatten()->toArray();
    }

}