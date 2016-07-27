<?php
/**
 * Created by PhpStorm.
 * User: rick
 * Date: 6/16/16
 * Time: 11:30 AM
 */

namespace App\Mps\Repositories;



use Prettus\Repository\Eloquent\BaseRepository;

class StockRepository extends BaseRepository
{
    /**
     *
     */
    public function boot(){
        $this->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
    }



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