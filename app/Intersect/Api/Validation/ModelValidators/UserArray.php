<?php
/**
 * Created by PhpStorm.
 * User: james
 * Date: 12/11/15
 * Time: 9:55 AM
 */

namespace App\Intersect\Api\Validation\ModelValidators;


use App\Intersect\Api\Support\KeyArray;
use App\Intersect\Api\Validation\ModelArrayValidator;

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