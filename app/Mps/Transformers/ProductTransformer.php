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
    public function transform($product)
    {

        return
            [
                'product_id' => $product['id'],
                'description' => $product['description'],
                'price' => $product['price']
            ];

    }
}