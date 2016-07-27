<?php
/**
 * Created by PhpStorm.
 * User: james
 * Date: 11/29/15
 * Time: 7:51 AM
 */

namespace App\Http\Controllers\Api;



use App\Http\Controllers\ApiController;
use App\Mps\Transformers\ProductTransformer;
use App\Mps\Validators\ProductValidator;
use App\Mps\Repositories\ProductRepository;
use Bosnadev\Repositories\Eloquent\Repository;

class ProductController extends ApiController
{
    public function __construct(ProductRepository $repository, ProductTransformer $transformer, ProductValidator $collectionValidator)
    {
        parent::__construct($repository, $transformer, $collectionValidator);
    }

    /** @return String */
    protected function key()
    {
        // TODO: Implement key() method.
    }
}