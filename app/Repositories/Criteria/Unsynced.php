<?php
/**
 * Created by PhpStorm.
 * User: rick
 * Date: 6/3/16
 * Time: 10:57 AM
 */

namespace App\Repositories\Criteria;



use Bosnadev\Repositories\Contracts\RepositoryInterface as Repository;
use Bosnadev\Repositories\Criteria\Criteria;

class Unsynced extends Criteria
{


    /**
     * @param $model
     * @param Repository $repository
     * @return mixed
     */
    public function apply($model, Repository $repository)
    {
        $model = $model->where('updated_at', '>', 120);
        return $model;
    }
}