<?php
/**
 * Created by PhpStorm.
 * User: rick
 * Date: 7/20/16
 * Time: 12:27 PM
 */

namespace App\Mps\Repositories;


use Bosnadev\Repositories\Eloquent\Repository;

class PresellSheetRepository extends Repository
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
}