<?php
/**
 * Created by PhpStorm.
 * User: rick
 * Date: 5/27/16
 * Time: 11:18 PM
 */

namespace App\Http\Controllers;


use App\Http\Requests\CreateOrderRequest;
use App\Mps\Response\Response as ApiResponse;
use App\Mps\Support\Helpers;
use App\Mps\Transformers\Transformer;
use App\Mps\Validators\CollectionValidator;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Prettus\Repository\Eloquent\BaseRepository;

abstract class ApiController extends Controller
{
    /** @var  ApiResponse */
    protected $response;

    /** @var  CollectionValidator $validator */
    protected $validator;

    /** @var  Transformer */
    protected $transformer;

    /** @var  BaseRepository $repository */
    protected $repository;

    private $table;

    /** @return String */
    protected abstract function key();

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

        $this->table = $repository->makeModel()->getTable();
    }

    /**
     *
     * Show a listing of the resource
     *
     * @return mixed
     */
    public function index()
    {

        $models = $this->repository->paginate(1000);

        if(! $models)
        {
            return $this->response->respondNotFound();
        }

        return $this->response
            //->setData($models->toArray())
            ->respond('resource listing',200,$models->toArray());

    }

    /**
     *
     * Show the specified resource
     *
     * @param $id
     * @return mixed
     *
     */
    public function show($id)
    {
        try{

            $model = $this->repository->find($id);
            return $this->response
                ->setData($model->toArray())
                ->respond('resource');
        }
        catch (ModelNotFoundException $e)
        {
            return $this->response->respondNotFound();
        }
        catch (\Exception $e){
            return $this->response->respondWithError($e->getMessage());
        }
    }

    /**
     *
     * Store a new resource to the database
     *
     * @param Request $request
     * @return mixed
     *
     */
    public function store(Request $request)
    {

        if($this->validator->validate())
        {

            $array = $request->input($this->key());


            if($this->storeBatch($array,$this->table)){

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

    /**
     *
     * Update an existing resource
     *
     * @param Request $request ID of the resource to be updated
     * @return ApiResponse|mixed
     *
     */
    public function update(Request $request)
    {
        /** @var Model $model */
        $model = $this->repository->find($request->input('id'));

        if($this->validator->setArray($model->toArray())->validate())
        {
            if($model->update($request->all())) {
                return $this->response->respondUpdated();
            }
            else{
                return $this->response->respondWithError('resource not saved');
            }

        }
        else{
            return $this->response->respondWithValidationErrors($this->validator->getErrors()->all());
        }

    }

    /**
     *
     *  Delete a resource from the database
     *
     * @param String $id ID of the resource to be updated
     * @return mixed
     * @internal param Request $request
     */
    public function destroy($id)
    {
        /** @var Model $resource */
        $resource = $this->repository->find($id);

        if($resource !== null){
            if($resource->delete()){
                return $this->response->respondDeleted();
            }else{
                return $this->response->respondWithError();
            }
        }
        else{
            return $this->response->respondNotFound('cannot delete a non existent resource');
        }
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

     public static function storeBatch(array $items,$table)
        {
           $now = Carbon::now();
            $items = collect($items)->map(function (array $data) use ($now) {
                return array_merge([
                    'created_at' => $now,
                    'updated_at' => $now,
                ], $data);
            })->all();

            //todo place inside transaction


            return DB::table($table)->insert($items);
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