<?php
/**
 * Created by PhpStorm.
 * User: james
 * Date: 12/1/15
 * Time: 11:29 AM
 */

namespace Intersect\Api\Validation\ModelValidators;

use Illuminate\Http\Request;
use Intersect\Api\Support\KeyArray;
use Intersect\Api\Validation\ModelArrayValidator;

class OrderArray extends ModelArrayValidator
{
    protected $key = 'orders';

    protected $required =
        [
            'orders',
            'order_details'
        ];

    protected function messages()
    {
        return
            [
                'id.in' => "all orders must have order details",
                'user_id.in'=>"only sales reps can make orders"
            ];
    }


    protected function rules()
    {
        $id_array = KeyArray::getArray($this->request['order_details'],'order_id');

        return
            [
                'id' => "required|unique:orders,id|in:".implode(',',$id_array),
                'sync_id' => 'required',
                'customer_id' => 'required|exists:customers,id',
                'order_status_id' => 'required',
                'user_id' => 'required|exists:users,id',
            ];
    }
}