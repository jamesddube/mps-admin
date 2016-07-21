<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\ApiController;
use App\Mps\Support\Helpers;
use App\Mps\Transformers\OrderTransformer;
use App\Mps\Validators\OrderValidator;
use App\Mps\Repositories\OrderRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends ApiController
{
    /**
     * Sample constructor.
     * @param OrderRepository $repository
     * @param OrderTransformer $transformer
     * @param OrderValidator $validator
     */
    public function __construct(OrderRepository $repository, OrderTransformer $transformer,OrderValidator $validator)
    {
        parent::__construct($repository,$transformer,$validator);
    }

    public function store(Request $request)
    {
        if($this->validator->validate())
        {

            $orders = Helpers::getModelCollection(
                'App\Order',
                $request->input('orders')
            );
            $details = Helpers::getModelCollection(
                'App\OrderDetail',
                $request->input('order_details')
            );

            DB::transaction(function () use ($orders,$details){
                foreach ($orders as $order) {
                    $order->save();
                }
                foreach ($details as $detail) {
                    $detail->save();
                }
            });

            return $this->setStatusCode(201)->respond([
                'message' => 'resource saved',
                'status_code'=>$this->getStatusCode()
            ]);

        }
        else
        {
            $errors = $this->validator->getErrors()->all();

            return $this->respondWithValidationErrors($errors);
        }
    }
}
