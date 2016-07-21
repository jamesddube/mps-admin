<?php
/**
 * Created by PhpStorm.
 * User: rick
 * Date: 6/16/16
 * Time: 11:30 AM
 */

namespace App\Mps\Repositories;


use Bosnadev\Repositories\Eloquent\Repository;

class StockRepository extends Repository
{

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return 'App\Stock';
    }
}