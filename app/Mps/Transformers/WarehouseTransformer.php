<?php
/**
 * Created by PhpStorm.
 * User: rick
 * Date: 6/16/16
 * Time: 4:09 PM
 */

namespace App\Mps\Transformers;


use App\Mps\Transformers\Transformer;

class WarehouseTransformer extends Transformer
{
    protected $transformKeys = [
        'id',
        'name'
    ];

    public function transformCollection($models)
    {
        return $models->load('stocks.product');
    }


}