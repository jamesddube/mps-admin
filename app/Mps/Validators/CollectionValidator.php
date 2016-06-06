<?php
/**
 * Created by PhpStorm.
 * User: rick
 * Date: 6/2/16
 * Time: 3:58 PM
 */

namespace App\Mps\Validators;


use App\Intersect\Api\Support\KeyArray;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class CollectionValidator 
{
    protected $array;
    protected $key = 'orders';
    protected function rules()
    {
        return array();
    }
   
    protected $request;
    protected $errors;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->array=$request->all();
    }

    public function validate()
    {
        $validator = Validator::make($this->getArray(), $this->rules());
        
        if($validator->fails())
        {
            $this->setErrors($validator->errors());
            
            return false;
        }
        
        return true;
      
    }

    /**
     * @return Request
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @return mixed
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @param mixed $errors
     */
    public function setErrors($errors)
    {
        $this->errors = $errors;
    }

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    public function getArray()
    {
        return $this->array;
    }

    public function setArray($array)
    {
        $this->array = $array;

        return $this;
    }


}