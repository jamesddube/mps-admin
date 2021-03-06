<?php
/**
 * Created by PhpStorm.
 * User: rick
 * Date: 6/2/16
 * Time: 10:40 AM
 */

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrderRequest;
use App\Mps\Support\Helpers;
use App\Mps\Transformers\OrderTransformer;
use App\Mps\Validators\OrderValidator;
use App\Order;
use App\Mps\Repositories\OrderRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Sample extends ApiController
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
        Log::debug($request->all());
        if($this->validator->validate())
        {
            $orders = $request->input('orders');

              DB::transaction(function () use ($orders){
                  foreach ($orders as $order)
                  {
                      $details = Helpers::getModelCollection(
                          'App\OrderDetail',
                          $order['order_details']
                      );

                      $newOrder = new Order($order);
                      ($newOrder->save());
                      $newOrder->lineItems()->saveMany($details);
                  }
              });

            return $this->response->respondCreated();

        }
        else
        {
            $errors = $this->validator->getErrors()->all();

             Log::debug($errors);

            return $this->response->respondWithValidationErrors($errors);
        }
    }

    /** @return String */
    protected function key()
    {
        return "orders";
    }
}