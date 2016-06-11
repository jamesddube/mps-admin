<?php
/**
 * Created by PhpStorm.
 * User: rick
 * Date: 6/2/16
 * Time: 12:17 PM
 */

namespace App\Mps\Transformers;


class UserTransformer extends Transformer
{
    
    protected $transformKeys = [
        'name',
        'surname'
    ];
}