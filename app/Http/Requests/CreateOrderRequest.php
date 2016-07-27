<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateOrderRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    /*public function rules()
    {
        $rules = [
            'hobbies' => 'required',
        ];
        foreach($this->request->get('hobbies') as $key=>$value)
        {
            $rules['items.'.$value] = 'required|integer';
        }
        return $rules;
    }*/
    public function rules()
    {
           return [
               'orders'  => "required|array",
               'orders.*.id' => "required|unique:orders,id",
               'orders.*.sync_status' => 'required|boolean',
               'orders.*.order_date' => 'required',
               'orders.*.customer_id' => 'required|exists:customers,id',
               'orders.*.order_status_id' => 'required',
               'orders.*.user_id' => 'required|exists:users,id',
               'orders.*.order_details'=>'required|array',
               'orders.*.order_details.*.quantity'  =>  'required',
               'orders.*.order_details.*.product_id'=>  'required|exists:products,id'
           ];



    }
}
