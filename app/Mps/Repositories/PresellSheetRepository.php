<?php
/**
 * Created by PhpStorm.
 * User: rick
 * Date: 7/20/16
 * Time: 12:27 PM
 */

namespace App\Mps\Repositories;



use Prettus\Repository\Eloquent\BaseRepository;

class PresellSheetRepository extends BaseRepository
{

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return 'App\PresellSheet';
    }

    public function boot(){
        $this->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
    }
}