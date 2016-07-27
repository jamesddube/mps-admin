<?php
/**
 * Created by PhpStorm.
 * User: rick
 * Date: 7/20/16
 * Time: 12:29 PM
 */

namespace App\Mps\Validators;


class PresellSheetValidator extends CollectionValidator
{
    protected function rules(){

        switch ($this->request->method())
        {
            case 'POST':
            {
                return [
                    'presell_sheets'  => "required|array",
                    'presell_sheets.*.id' => "required|unique:presell_sheets,id",
                    'presell_sheets.*.route_id' => "required|exists:routes,id",
                    'presell_sheets.*.status_id' => 'required|boolean',
                    'presell_sheets.*.user_id' => 'required|exists:users,id',
                ];
                break;
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



                break;
            }
        }


    }

}