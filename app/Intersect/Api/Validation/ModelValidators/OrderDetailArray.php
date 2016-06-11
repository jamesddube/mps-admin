<?php
/**
 * Created by PhpStorm.
 * User: rick
 * Date: 5/22/16
 * Time: 6:44 PM
 */

namespace App\Intersect\Api\Validation\ModelValidators;


use App\Intersect\Api\Validation\ModelArrayValidator;

class OrderDetailArray extends ModelArrayValidator
{
    protected $key = "order_details";

    protected function rules()
    {
        return 
            [
                "quantity"  =>  "required",
                "product_id"=>  "required|exists:products,id"
            ];
    }


}