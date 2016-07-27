<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Mps\Support\Helpers;
use App\Mps\Traits\SyncableTrait;
use App\Mps\Transformers\CustomerTransformer;
use App\Mps\Validators\CustomerValidator;
use App\Mps\Repositories\CustomerRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Prettus\Repository\Eloquent\BaseRepository;

class CustomerController extends ApiController
{
    use SyncableTrait;
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

    public function sync(Request $request)
    {
        return $this->syncNew($request->input('ids'));
    }

    /** @return BaseRepository */
    public function repo()
    {
        return $this->repository;
    }

    /** @return String */
    protected function key()
    {
        // TODO: Implement key() method.
    }
}
