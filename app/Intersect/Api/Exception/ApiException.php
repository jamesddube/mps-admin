<?php
/**
 * Created by PhpStorm.
 * User: james
 * Date: 12/9/15
 * Time: 4:31 PM
 */

namespace Intersect\Api\Exception;


use \Exception;

class ApiException extends Exception
{
    // Redefine the exception so message isn't optional
    public function __construct($message, $code = 500, Exception $previous = null) {
        // some code

        // make sure everything is assigned properly
        parent::__construct($message, $code, $previous);
    }

    // custom string representation of object
    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }

}