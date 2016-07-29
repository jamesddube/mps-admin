<?php
/**
 * Created by PhpStorm.
 * User: rick
 * Date: 7/25/16
 * Time: 10:42 AM
 */

namespace App\Mps\Response;


class Response
{
    /**
     *
     * HTTP Status Code
     *
     * @var  $status_code int
     */
    private $status_code;
    
    private $data = array();

    private $validationErrors = array();

    /**
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->status_code;
    }

    /**
     *
     * Sets the HTTP status code for the response
     *
     * @param mixed $status_code
     * @return $this
     *
     */
    public function setStatusCode($status_code)
    {
        $this->status_code = $status_code;
        
        return $this;
    }

    /**
     *
     * Respond with a 404. The resource/model cannot be found in the database
     *
     * @param string $message
     * @return mixed
     *
     */
    public function respondNotFound($message = 'resource not found'){
        return $this->respondWithError($message,404);
    }

    /**
     *
     * Respond with a 422. There were some validation errors on
     * the input data
     *
     * @param $errors array
     * @return \Illuminate\Http\JsonResponse
     *
     */
    public function respondWithValidationErrors($errors)
    {
        return $this->setValidationErrors($errors)->respondWithError('validation errors',422);
        
    }

    /**
     *
     * Generic error response. HTTP Status code of 500 by default
     *
     * @param string $message
     * @param int $code
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     *
     */
    public function respondWithError($message = 'an error occurred',$code = 500, $data = array())
    {
        $meta =[
            'status' => 'error',
            'message'=> $message,
            'status_code'=>$code,
        ];

        if($this->hasValidationErrors()) {
            $responseData = array_merge($meta,$this->getValidationErrors(),$data);
        }
        else{
            $responseData = array_merge($meta,$data);
        }

        return $this->setStatusCode($code)->generalRespond($responseData);

    }

    /**
     *
     * Respond with a 204. The resource was updated
     *
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     *
     */
    public function respondUpdated($message = 'resource updated')
    {
        return $this->respond($message,200);
    }

    /**
     *
     * Generic response for a successful response. Default HTTP status code is 200
     *
     * @param string $message
     * @param int $code
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     *
     */
    public function respond($message = 'request success',$code = 200, $data = array()){
        
        $meta =[
            'status' => 'success',
            'message'=> $message,
            'status_code'=>$code,
        ];

        if($this->hasData()) {
            $responseData = array_merge($meta,$this->getData(),$data);
        }
        else{
            $responseData = array_merge($meta,$data);
        }

        return $this->setStatusCode($code)->generalRespond($responseData);
    }
    
    public function respondCreated($msg = 'resource created'){
        return $this->respond($msg,201);
    }
    
    protected function generalRespond($data)
    {
        
        return response()->json($data,$this->getStatusCode());
        
    }

    /**
     * @param array $data
     * @return Response
     */
    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }

    public function getData()
    {
        return array('data' => $this->data);
    }


    /** @return boolean */
    public function hasData(){
        return  (count($this->getData()['data'])) > 0 ;
    }

    /** @return boolean */
    public function hasValidationErrors(){
        return  (count($this->getValidationErrors()['validation_errors'])) > 0 ;
    }

    /**
     * @param array $validationErrors
     * @return Response
     */
    public function setValidationErrors($validationErrors)
    {
        $this->validationErrors = $validationErrors;
        return $this;
    }

    /**
     * @return array
     */
    public function getValidationErrors()
    {
        return array('validation_errors' => $this->validationErrors);
    }

    /**
     * 
     */
    public function respondDeleted()
    {
        return $this->respond('the resource was deleted');
    }


}