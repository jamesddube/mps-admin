<?php
/**
 * Created by PhpStorm.
 * User: rick
 * Date: 6/2/16
 * Time: 10:32 PM
 */

namespace App\Mps\Transformers;


class OrderTransformer extends Transformer
{
    protected $transformKeys = [
        'id',
        'customer_id'
    ];

}