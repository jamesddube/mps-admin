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

    /** @return String */
    protected function key()
    {
        return "orders";
    }
}
