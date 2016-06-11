<?php
/**
 * Created by PhpStorm.
 * User: rick
 * Date: 6/6/16
 * Time: 9:22 PM
 */

namespace App\Repositories;


use Bosnadev\Repositories\Eloquent\Repository;

class ProductRepository extends Repository
{

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return 'App\Product';
    }
}