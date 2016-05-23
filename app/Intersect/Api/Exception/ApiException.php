<?php
/**
 * Created by PhpStorm.
 * User: james
 * Date: 12/9/15
 * Time: 4:31 PM
 */

namespace Intersect\Api\Exception;


use Symfony\Component\HttpKernel\Exception\HttpException;

class ApiException extends HttpException
{
    public function __construct($statusCode, $message, \Exception $previous, array $headers, $code)
    {
        parent::__construct($statusCode, $message, $previous, $headers, $code);
    }
}