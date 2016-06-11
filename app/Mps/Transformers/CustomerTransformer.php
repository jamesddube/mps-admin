<?php
/**
 * Created by PhpStorm.
 * User: rick
 * Date: 6/2/16
 * Time: 10:32 PM
 */

namespace App\Mps\Transformers;


class CustomerTransformer extends Transformer
{
    protected $transformKeys = [
        'id',
        'name',
        'vat_number',
        'address',
        'telephone',
        'fax',
        'email',
        'city',
        

    ];
    
    protected $key = 'customers';
    


}