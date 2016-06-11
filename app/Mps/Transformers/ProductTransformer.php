<?php
/**
 * Created by PhpStorm.
 * User: rick
 * Date: 6/6/16
 * Time: 12:40 AM
 */

namespace App\Mps\Transformers;


class ProductTransformer extends Transformer
{
    protected $transformKeys = [
        'id',
        'description',
        'price',
        'image'
    ];
}