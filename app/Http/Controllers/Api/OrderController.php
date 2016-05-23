<?php

namespace App\Http\Controllers\Api;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intersect\Api\Controller\ApiController;
use Intersect\Api\Validation\ModelValidators\OrderArray;
use Intersect\Api\Validation\ModelValidators\OrderDetailArray;

class OrderController extends ApiController
{
    public function store(Request $request)
    {
      

        $odc =new OrderDetailController();
        $odc->runValidation($request->toArray());
        $this->runValidation($request->toArray());
        
        $ordersArray = $request->input($this->getModelArrayKey());
        $order_detailsArray = $request->input('order_details');

        $orders = $this->getModelCollection($ordersArray)->toArray();
        $order_details = $odc->getModelCollection($order_detailsArray)->toArray();

        DB::transaction(function () use ($orders,$order_details) {
            DB::table('orders')->insert($orders);
            DB::table('order_details')->insert($order_details);
        });

        return response()->json(["message"=>"entity processed"] , 201);

    }
}
