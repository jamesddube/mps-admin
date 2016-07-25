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
    private $status_code;

    /**
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->status_code;
    }

    /**
     * @param mixed $status_code
     * @return $this
     */
    public function setStatusCode($status_code)
    {
        $this->status_code = $status_code;
        
        return $this;
    }
    
    public function respondNotFound($msg = 'resource not found'){
        return $this->respondWithError($msg,404);
    }
    
    public function respondWithValidationErrors($errors)
    {
        return $this->respondWithError('validation errors',422,$errors);
        
    }
    
    public function respondWithError($message = 'an error occurred',$code = 500, $data = array())
    {
        $meta =[
            'status' => 'error',
            'message'=> $message,
            'status_code'=>$code,
            'data' => $data
        ];

        return $this->setStatusCode($code)->generalRespond(array_merge($meta));
    }
    
    public function respond($message = 'request success',$code = 200, $data = array()){
        
        $meta =[
            'status' => 'success',
            'message'=> $message,
            'status_code'=>$code,
            'data' => $data
        ];
        
        return $this->setStatusCode($code)->generalRespond(array_merge($meta));
    }
    
    public function respondCreated($msg = 'resource created'){
        return $this->respond($msg,201);
    }
    
    private function generalRespond($data)
    {
        
        return response()->json($data,$this->getStatusCode());
        
    }

}