<?php
/**
 * Created by PhpStorm.
 * User: rick
 * Date: 6/16/16
 * Time: 4:10 PM
 */

namespace App\Mps\Transformers;


use App\Mps\Transformers\Transformer;

class RouteTransformer extends Transformer
{
    protected $transformKeys = [
        'id',
        'warehouse_id',
    ];
}