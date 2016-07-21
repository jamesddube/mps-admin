<?php
/**
 * Created by PhpStorm.
 * User: rick
 * Date: 6/2/16
 * Time: 12:11 PM
 */

namespace App\Mps\Transformers;


Class Transformer
{
    protected $key = 'data';
    
    protected $transformKeys = [];
    
    public function transform($model)
    {
        $data = [];

        if(count($this->transformKeys) == 0)
        {
            return $model;
        }

        foreach ($this->transformKeys as $key)
        {
            $data[$key] = $model[$key];
        }

        return $data;
    }

    public function transformCollection(array $modelsArray)
    {
        return array_map([$this, 'transform'],$modelsArray);
    }

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }
}