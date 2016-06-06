<?php
/**
 * Created by PhpStorm.
 * User: rick
 * Date: 5/27/16
 * Time: 11:18 PM
 */

namespace App\Http\Controllers;


use App\Customer;
use App\Http\Requests\CreateOrderRequest;
use App\Mps\Support\Helpers;
use App\Mps\Transformers\Transformer;
use App\Mps\Validators\CollectionValidator;
use Bosnadev\Repositories\Eloquent\Repository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ApiController extends Controller
{

    /** @var  CollectionValidator $validator */
    protected $validator;

    protected $statusCode = 200;

    /** @var  Transformer */
    protected $transformer;

    /** @var  Repository $repository */
    protected $repository;

    /**
     * Api constructor.
     * @param Repository $repository
     * @param Transformer $transformer
     * @param CollectionValidator $collectionValidator
     */
    public function __construct(Repository $repository, Transformer $transformer,CollectionValidator $collectionValidator)
    {
        $this->transformer = $transformer;
        $this->repository = $repository;
        $this->validator = $collectionValidator;
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

        if($this->validator->validate())
        {
            $array = $request->input($this->transformer->getKey());

            $this->repository->saveModel($array);

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

    public function update()
    {
        $model = $this->repository->find('OD5000');

        $model->user_id = 90;
        
        if($this->validator->setArray($model->toArray())->validate())
        {
            return $this->respond(['message' => 'we can save']);
        }

        return $this->respondWithValidationErrors($this->validator->getErrors()->all());
        
    }

    public function storeCollection(Request $request)
    {
        if($this->validator->validate())
        {
            $m = $request->input($this->transformer->getKey());
            $array = Helpers::getModelCollection(
                $this->repository->getModelInstance(),
                $this->repository->collectModels($m)->toArray()
            );

            foreach ($array as $model)
            {
                $model->save();
            }

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

    public function sync(Request $request)
    {
        return $request->all();
        /*return Customer::select()
            ->where('updated_at','>',Carbon::now())
            ->whereNotIn('id', ['OD5000'])->get();
        */
    }


    public function respond($data,$headers= [])
    {
        return response()->json($data,$this->getStatusCode(),$headers);
    }

    public function respondCollection($data)
    {
        return response()->json([
            'status_code'=>$this->getStatusCode(),
            $this->transformer->getKey() => $this->transformer->transformCollection($data),
        ],$this->getStatusCode());
    }

    public function respondWithValidationErrors($errors)
    {
        $data=[];
        foreach ($errors as $error)
        {
            $data[] = $error;
        }
        return $this->setStatusCode(422)->respond([

                'message' => 'Validation Errors',
                'errors'  => $data
            ]);

        //$this->respondWithError(['errors' => $data],400);

    }

    public function respondWithError($message = 'Internal Error',$statusCode = 500)
    {
        $this->setStatusCode($statusCode)->respond([
                'error' => [
                        'message' => $message
                    ]]);
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