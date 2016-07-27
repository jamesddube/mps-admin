<?php
/**
 * Created by PhpStorm.
 * User: rick
 * Date: 6/27/16
 * Time: 10:13 PM
 */

namespace app\Mps\Presenters;


trait PresentableTrait
{
    protected static $presenterInstance;

    public function present(){
        if(!isset($this->presenter) or class_exists($this->presenter))
        {
            throw  new \Exception('Please set a valid path for your presenter');
        }

        if(!isset(static::$presenterInstance))
        {
            static::$presenterInstance = new $this->presenter($this);
        }

        return static::$presenterInstance;
    }
}