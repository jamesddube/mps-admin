<?php
/**
 * Created by PhpStorm.
 * User: james
 * Date: 12/11/15
 * Time: 12:31 PM
 */

namespace Intersect\Api\Validation\RequestValidators;


use Intersect\Api\Validation\RequestValidator;

class UserRequest extends RequestValidator
{
    protected $required =
        [
            'users'
        ];

}