<?php
/**
 * Created by PhpStorm.
 * User: rick
 * Date: 6/2/16
 * Time: 10:35 AM
 */

namespace App\Mps\Controller;

use App\Http\Requests\CreateOrderRequest;
use App\Http\Requests\CreateUserRequest;

use App\Mps\Transformers\Transformer;
use App\Mps\Validators\CollectionValidator;
use Bosnadev\Repositories\Eloquent\Repository;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Api extends Controller
{
    private $statusCode = 200;
    
    /** @var  Transformer */
    protected $transformer;

    /** @var  Repository $repository */
    protected $repository;

    /**
     * Api constructor.
     * @param Repository $repository
     * @param Transformer $transformer
     */
    public function __construct(Repository $repository, Transformer $transformer)
    {
        $this->transformer = $transformer;
        $this->repository = $repository;
    }

    /**
     * @return mixed
     */
    public function index()
    {
        $models = $this->repository->all();

        if(! $models)
        {
            throw new NotFoundHttpException('resources not found');
        }
        return $this->respondCollection($models);
    }

    public function show($id)
    {
        $model = $this->repository->find($id);

        if(! $model)
        {
            throw new NotFoundHttpException('resource not found');
        }
        return $this->respond($model);
    }

   public function store(Request $request)
   {

       /** @var \Illuminate\Contracts\Validation\Validator $validation */
       $validation = Validator::make(
           $request->all(),
           [
               'name' => 'required|numeric'
           ]
       );

       if ($validation->fails()) {
           dd($validation->getMessageBag()->all());
       }
      /*$this->validate($request->all(),[
          'orders'  =>  'required'
      ]);*/



   }



    public function respond($data)
    {
        return response()->json([
            'data' => $this->transformer->transform($data),
        ],$this->getStatusCode());
    }

    public function respondCollection($data)
    {
        return response()->json([
            'status_code'=>$this->getStatusCode(),
            'data' => $this->transformer->transformCollection($data),
        ],$this->getStatusCode());
    }

    /**
     * @param int $statusCode
     * @return Api
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    /**
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }


}