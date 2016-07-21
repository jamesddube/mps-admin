<?php
/**
 * Created by PhpStorm.
 * User: rick
 * Date: 6/2/16
 * Time: 9:58 AM
 */

namespace App\Mps\Repositories;
use Bosnadev\Repositories\Eloquent\Repository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class UserRepository extends Repository implements RepositoryInterface
{
    public function model() {
        return 'App\User';
    }


    public function key()
    {
        return 'orders';
    }

    public function modelInstance()
    {
        // TODO: Implement modelInstance() method.
    }
}