<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Mps\Support\Helpers;
use App\Mps\Transformers\CustomerTransformer;
use App\Mps\Validators\CustomerValidator;
use App\Mps\Repositories\CustomerRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends ApiController
{
    /**
     * CustomerController constructor.
     * @param CustomerRepository $repository
     * @param CustomerTransformer $transformer
     * @param CustomerValidator $validator
     */
    public function __construct(CustomerRepository $repository, CustomerTransformer $transformer, CustomerValidator $validator)
    {
        parent::__construct($repository,$transformer,$validator);
    }
}
