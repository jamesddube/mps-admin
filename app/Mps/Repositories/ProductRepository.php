<?php
/**
 * Created by PhpStorm.
 * User: rick
 * Date: 6/6/16
 * Time: 9:22 PM
 */

namespace App\Mps\Repositories;



use Prettus\Repository\Eloquent\BaseRepository;

class ProductRepository extends BaseRepository
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