<?php
/**
 * Created by PhpStorm.
 * User: james
 * Date: 12/1/15
 * Time: 4:28 PM
 */

namespace Intersect\Api\Support;


use Illuminate\Support\Collection;

class KeyArray
{
    private static $key;

    public static function getArray($array , $key)
    {
        self::$key = $key;

        $collection = Collection::make($array);

        $id = $collection->map(function($od){
            return $od[self::$key];
        });

        return $id->flatten()->toArray();
    }

}