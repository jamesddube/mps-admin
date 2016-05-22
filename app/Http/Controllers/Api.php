<?php

namespace App\Http\Controllers;

use App\OrderDetail;
use App\OrderDetailsModel;
use App\OrderModel;
use App\User;
use Exception;
use Faker\Factory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class Api extends Controller
{
    //

    /**
     * @desc An instance of the OrderModel Class
     * @var array OrderModel
     */
    private static $model = array();

    /**
     * @var \StdClass
     */
    private static $jsonObject;

    /**
     * @var array
     */
    public $modelAttributes;

    public static function isJson($input)
    {
        if (is_string($input)) {
            if (json_decode($input)) {
                return true;
            }
        }

        throw new BadRequestHttpException ("invalid json string");
    }

    public static function validateProperties(Model $model)
    {
        switch ($model) {
            case is_a($model,OrderDetail::class) :
                $validator = Validator::make($model->getAttributes(), [
                    'order_details_id' => 'required',
                    "order_id" => "required",
                    "quantity" => "required|numeric",

                ]);if ($validator->fails()) {

                    self::validationErrors($validator->errors());
                }
            break;

            case is_a($model,OrderModel::class) :
                $validator = Validator::make($model->getAttributes(), [
                    'order_id' => 'required',
                    "customer_id" => "required",
                    "sales_rep" => "required",
                    "order_status" => "required",
                ]);if ($validator->fails()) {

                self::validationErrors($validator->errors());
            }
                break;

        }

    }


    /**
     * @param $string
     * @throws Exception
     */
    public function validateModel($string)
    {
        foreach ($this->getModelAttributes() as $attribute) {
            if (is_null(object_get($string, $attribute))) {
                throw new Exception ("required Model attribute $attribute, not found");
            }
        }
    }

    public function setModelAttributes(Model $model)
    {
        $this->modelAttributes = $model->getFillable();
    }

    public static function filterModelAttributes($array,Model $model)
    {
        $column = array();

        foreach ($array as $attribute => $value) {

            if(in_array($attribute,$model->getFillable()))
            {
                $column[] = $attribute;
            }

        }

        array_has($column,$model->getKeyName()) == false & count($column) > 0 ? $column[] = $model->getKeyName() : null;

        return count($column) > 0 ? $column : array('*');
    }

    public static function hasLineItems($string)
    {
        if (is_null(object_get($string, 'order_details'))) {
            throw new Exception ("required 'order_details' attribute not found or is not in the correct format");
        }
    }

    /**
     * @param $order OrderModel
     * @param $model Model
     * @internal param $i
     */
    public function setAttributes($order, $model)
    {
        foreach ($this->getModelAttributes() as $attribute) {
            $model->setAttribute($attribute, $order->$attribute);
        }

    }

    /**
     * @param $msg_desc
     * @param bool $error
     * @return \Illuminate\Http\JsonResponse
     */
    public static function genMessage($msg_desc, $error = false, $error_type = "an error occured")
    {

        return $error == true ?
            response()->json(['error' => $error, 'error_type' => $error_type, 'error_description' => $msg_desc]) :
            response()->json(['error' => $error, 'message' => $msg_desc]);

    }

    /**
     * @param $obj array
     * @param Model $model
     * @return array Model
     * @throws Exception
     */
    public static function getModelsFromJson($obj, Model $model)
    {
        for ($i = 0; $i < count($obj); $i++) {

            self::$model[] = new $model();

            foreach(get_object_vars($obj[$i]) as $key => $value)
            {
                self::$model[$i]->setAttribute($key, $value);
            }
            self::validateProperties(self::$model[$i]);

        }

        return self::$model;
    }

    /**
     * @param array $input
     * @return array
     */
    public static function getObject($input)
    {
        if (self::isJson($input)) {
            return self::$jsonObject = json_decode($input);
        }
    }

    public static function getObjectAttribute($attribute)
    {
        try {
            return self::$jsonObject->$attribute;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public static function all()
    {
        return self::$model[0]->getAttributes();
    }

    private static function validationErrors($messages)
    {
        $bag = "";

        print_r($messages);

        foreach ($messages->all() as $message) {
            //
             $bag .=  $message." ";
        }

        throw new Exception ($bag);
    }

    /**
     * @return array
     */
    public function getModelAttributes()
    {
        return $this->modelAttributes;
    }

    /**
     * @param $model
     * @param int $number
     * @return string
     * @throws Exception
     */
    public static function sample($model ,$number = 2)
    {
        $faker = Factory::create();


        switch ($model)
        {
            case(is_a($model,OrderDetailsModel::class)) :
                for($i = 0 ; $i < $number ; $i++)
                {
                    $order_id = $faker->numerify('OD-########');
                    $sample[] = array
                    (
                        "order_details_id" => $order_id . $faker->numerify("-##"),
                        "order_id" => $order_id,
                        "product_id" => $faker->randomDigit . '0' . $faker->randomDigit . '0',
                        "quantity" => $faker->randomNumber(2),
                    );
                }
                break;

            case(is_a($model,OrderModel::class)) :

                for($i = 0 ; $i < $number ; $i++)
                {
                    $order_id = $faker->numerify('OD-########');
                    $sample[] = array
                    (
                        "order_id" => $order_id,
                        "customer_id" => ucfirst($faker->randomLetter).$faker->numerify('-###'),
                        "sales_rep" => strtolower($faker->firstName."@mbc.co.zw"),
                        "order_status" => $faker->randomElement($array = array ('draft','unprocessed','processed')),
                        "sync_status" =>1,
                    );
                }
                break;

            case(is_a($model,User::class)) :

                for($i = 0 ; $i < $number ; $i++)
                {
                    $fname = $faker->firstName;
                    $lname = $faker->lastName;
                    $sample[] = array
                    (
                        'user_code' => strtoupper(str_random(3)),
                        'name' => $fname,
                        'surname' =>$lname,
                        'job_title' => $faker->job_title,
                        'email' => strtolower(substr($fname,0,1).$lname).'@mbc.com',
                        'password' => bcrypt('secret'),
                        'user_type' => 1,
                    );
                }
                break;

            default :
                throw new Exception ("class $model not found" );
        }

        return  json_encode($sample);
    }


}
