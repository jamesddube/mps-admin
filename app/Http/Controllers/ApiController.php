<?php
/**
 * Created by PhpStorm.
 * User: rick
 * Date: 5/27/16
 * Time: 11:18 PM
 */

namespace App\Http\Controllers;


use App\Mps\Response\Response as ApiResponse;
use App\Mps\Support\Helpers;
use App\Mps\Transformers\Transformer;
use App\Mps\Validators\CollectionValidator;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Prettus\Repository\Eloquent\BaseRepository;

class ApiController extends Controller
{
    /** @var  ApiResponse */
    protected $response;

    /** @var  CollectionValidator $validator */
    protected $validator;

    protected $statusCode = 200;

    /** @var  Transformer */
    protected $transformer;

    /** @var  BaseRepository $repository */
    protected $repository;

    /**
     * Api constructor.
     * @param BaseRepository $repository
     * @param Transformer $transformer
     * @param CollectionValidator $collectionValidator
     */
    public function __construct(BaseRepository $repository, Transformer $transformer,CollectionValidator $collectionValidator)
    {
        $this->transformer = $transformer;
        $this->repository = $repository;
        $this->validator = $collectionValidator;
        $this->response = new ApiResponse();
    }

    /**
     * @return mixed
     */
    public function index()
    {

        $models = $this->repository->paginate(1000);

        if(! $models)
        {
            return $this->response->respondNotFound();
        }

        return $this->response->respond($models->toArray());

    }

    /**
     *
     * Show the specified resource
     *
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        try{

            $model = $this->repository->find($id);
            return $this->response->respond(['data'=>$model->toArray()]);
        }
        catch (\Exception $e)
        {
            return $this->response->respondNotFound();
        }
    }

    public function store(Request $request)
    {

        if($this->validator->validate())
        {
            $array = $request->all();

            if($this->storeBatch($array)){

                return $this->response->respondCreated();
            };

            return $this->response->respondWithError();

        }
        else
        {
            $errors = $this->validator->getErrors()->all();
            
            return $this->response->respondWithValidationErrors($errors);
        }


    }
/*
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

  */  public static function storeBatch(array $items)
    {
        $now = Carbon::now();
        $items = collect($items)->map(function (array $data) use ($now) {
            return array_merge([
                'created_at' => $now,
                'updated_at' => $now,
            ], $data);
        })->all();

        return DB::table('orders')->insert($items);
    }

    public function sync(Request $request)
    {
        return $request->all();
        /*return Customer::select()
            ->where('updated_at','>',Carbon::now())
            ->whereNotIn('id', ['OD5000'])->get();
        */
    }


}