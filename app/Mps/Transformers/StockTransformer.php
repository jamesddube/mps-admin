<?php
/**
 * Created by PhpStorm.
 * User: rick
 * Date: 6/6/16
 * Time: 12:44 AM
 */

namespace App\Mps\Transformers;


class StockTransformer extends Transformer
{
    protected $transformKeys = [
    	'id',
        'warehouse_id',
        'product_id',
        'quantity',
    ];
}