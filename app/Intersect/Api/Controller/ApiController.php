<?php
/**
 * Created by PhpStorm.
 * User: james
 * Date: 12/9/15
 * Time: 2:21 PM
 */

namespace Intersect\Api\Controller;


use App\Http\Controllers\Controller;
use App\Order;
use App\User;
use Carbon\Carbon;
use Dingo\Api\Exception\ValidationHttpException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intersect\Api\Request\QueryBuilder;
use Intersect\Api\Response\Json;
use Intersect\Api\Validation\ModelArrayValidator;
use JavaScript;
use Symfony\Component\Debug\Exception\ClassNotFoundException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class ApiController extends Controller
{
    /** @var  Model $model */
    protected $model;
    protected $requestValidator;
    protected $modelArray;

    public function __construct()
    {
        if($this->model == null)
        {
            $model = '\App\\'.str_replace("Controller",'',class_basename($this));
            if(class_exists($model))
            {
                $this->setModel($model);

                $user = new User();

            }
            else
            {
                throw new \Exception('Model '.$model.' not found or does not exist');
            }

        }

        if($this->modelArray == null)
        {
            $this->setModelArray('\Intersect\Api\Validation\ModelValidators\\'.str_replace("Controller",'',class_basename($this)).'Array');
        }

        if($this->requestValidator == null)
        {
            $this->requestValidator = ('\Intersect\Api\Validation\RequestValidators\\'.str_replace("Controller",'',class_basename($this)).'Request');
        }

    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param mixed $model
     */
    public function setModel($model)
    {
        $this->model = $model;
    }
    public function index(Request $request)
    {

        //throw new AccessDeniedHttpException("what are you doing?");
        /*@todo Query Parameters should consist of a model's attribute, in other words get the attributes of a model dynamically and use them as query params!
        */

        $OrderQueryBuilder = new QueryBuilder(new $this->model);

        $OrderQueryBuilder->applyParameters($request->all());

        $resource = $OrderQueryBuilder->get();
        /** @var ModelArrayValidator $ma */
        $ma = new $this->modelArray();

        //($ma->getKey());

        return [$ma->getKey() => $resource];

        //return is_null($resource) ? Json::response(['status'=>'error','message' => 'resource not found','status_code'=>404]) : Json::response(['message_data' => $resource]);

        //return $OrderQueryBuilder->get();
    }

    public function show($id)
    {
        $model = $this->model;

        $userj = ($model::find($id));

        return $userj;

        return is_null($user) ? Json::response(['status'=>'error','message' => 'resource not found','status_code'=>404]) : Json::response(['message_data' => $user]);
    }

    public function store(Request $request)
    {

        $validator = new $this->modelArray($request);

        $validator->validate($request->all());

        if(count($validator->getErrors()) === 0)
        {
            $model = new $this->model;

            $key = $this->getModelArrayKey();

            $data = $request->input($key);

            if(DB::table($model->getTable())->insert($data))
            {
                return response()->json(["message"=>"entity processed"] , 201);
            }

        }
        else
        {
            throw new ValidationHttpException($validator->getMessageBag());
        }
    }

    private function setModelArray($string)
    {
        if (class_exists($string))
        {
            $this->modelArray = $string;
        }
        else throw new \Exception("Class $string not found, please create the Model Validator");

    }

    private function getModelArrayKey()
    {
        $m = new $this->modelArray();

        return $m->getKey();
    }

    private function getModelAttributes()
    {
        $m = new $this->model();

        return ($m->getFillable());
    }

    public function getUpdated(Request $request)
    {
        return $this->model::Unsynced(Carbon::now())->get();
        //$model::where('updated_at','>',$date)->get();
    }

}
