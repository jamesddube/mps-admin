<?php
/**
 * Created by PhpStorm.
 * User: rick
 * Date: 6/2/16
 * Time: 10:23 PM
 */

namespace App\Mps\Validators;


use App\Intersect\Api\Support\KeyArray;

class CustomerValidator extends CollectionValidator
{
    
    protected function rules(){
        
        switch ($this->request->method())
        {
            case 'POST':
            {
                $orders_id = KeyArray::getArray($this->request['order_details'],'order_id');
                $details_id = KeyArray::getArray($this->request['orders'],'id');
                return [
                    'orders.*.id' => "required|unique:orders,id|in:".implode(',',$orders_id),
                    'orders.*.sync_id' => 'required',
                    'orders.*.order_date' => 'required',
                    'orders.*.customer_id' => 'required|exists:customers,id',
                    'orders.*.order_status_id' => 'required',
                    'orders.*.user_id' => 'required|exists:users,id',
                    'order_details'=>'required',
                    'order_details.*.id'=>"required|unique:order_details,id",
                    'order_details.*.order_id'=>"required|in:".implode(',',$details_id),
                    'order_details.*.quantity'  =>  'required',
                    'order_details.*.product_id'=>  'required|exists:products,id'
                ];
            }
            
            case 'PUT':
            {
                return [
                    'orders.*.id' => "required|exists:orders,id",
                    'orders.*.sync_id' => 'required',
                    'orders.*.order_date' => 'required',
                    'orders.*.customer_id' => 'required|exists:customers,id',
                    'orders.*.order_status_id' => 'required',
                    'orders.*.user_id' => 'required|exists:users,id',
                    'order_details'=>'sometimes',
                    'order_details.*.id'=>"required|unique:order_details,id",
                    'order_details.*.order_id'=>"required",
                    'order_details.*.quantity'  =>  'required',
                    'order_details.*.product_id'=>  'required|exists:products,id'
                ];
            }
        }
        
        
    }
}