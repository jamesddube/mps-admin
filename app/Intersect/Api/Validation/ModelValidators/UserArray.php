<?php
/**
 * Created by PhpStorm.
 * User: james
 * Date: 12/11/15
 * Time: 9:55 AM
 */

namespace Intersect\Api\Validation\ModelValidators;


use Intersect\Api\Support\KeyArray;
use Intersect\Api\Validation\ModelArrayValidator;

class UserArray extends ModelArrayValidator
{
    protected $key = 'users';

    protected function rules()
    {
        $id_array = KeyArray::getArray($this->request->input('od'),'id');

        return
            [
                'id' => "required|in:".implode(',',$id_array),
            ];
    }

}