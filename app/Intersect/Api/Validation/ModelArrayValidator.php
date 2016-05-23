<?php
/**
 * Created by PhpStorm.
 * User: james
 * Date: 11/30/15
 * Time: 11:50 PM
 */

namespace Intersect\Api\Validation;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Intersect\Api\Exception\ApiException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

abstract class ModelArrayValidator
{
    protected $key;

    protected $request;

    protected $required = [];

    protected $errors;
    
    protected $messages;

    protected $messageBag;

    public function getKey()
    {
        if ($this->key == null)
        {
            throw new \Exception("please set the Model key for $this");
        }
        return $this->key;
    }

    protected function rules()
    {
        return array();
    }

    protected function messages()
    {
        return array();
    }

    public function validate(array $request)
    {
        $this->request = $request;

        if(isset($request[$this->key]))
        {
            $collection = Collection::make(array_keys($this->request));

            foreach ($this->required as $key)
            {
                if ( $collection->contains($key) === false )
                {
                    throw new BadRequestHttpException("key attribute $key not found");
                }
            }

            foreach ($request[ $this->key ] as $order)
            {
                $v = Validator::make($order , $this->rules(),$this->messages());

                if ( $v->fails() )
                {
                    $errors = ($v->errors()->all());

                    $this->errors = $errors;

                    $this->messageBag = $v->errors();

                    //throw new ApiException($errors);
                    //throw new BadRequestHttpException($errors);
                    //die();
                }
            }

            return true;
        }
        else
        {
            throw new BadRequestHttpException("$this->key object not found");
        }



    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function getMessageBag()
    {
        return $this->messageBag;
    }




}
