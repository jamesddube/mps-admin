<?php
/**
 * Created by PhpStorm.
 * User: james
 * Date: 12/9/15
 * Time: 4:26 PM
 */

namespace App\Intersect\Api\Response;


use Symfony\Component\HttpFoundation\Response;

class Json
{
    public static function response($input)
    {
        $response =
            [
                'status' => "OK",
                'status_code' => 200,
                'message' => null ,
                'message_data' => null,
                'error_messages' => null
            ];

        foreach ($response as $key => $value)
        {
            $response[ $key ] = isset($input[ $key ]) ? $input[ $key ] : $response[ $key ];
        }

        if($response[ 'status' ] === 'error')
        {
            $response['status_code'] = $response['status_code'] === Response::HTTP_OK ? Response::HTTP_INTERNAL_SERVER_ERROR : $response['status_code'] ;
        }

        return response()->json($response , $response['status_code']);
    }

}