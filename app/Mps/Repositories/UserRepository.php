<?php
/**
 * Created by PhpStorm.
 * User: rick
 * Date: 6/2/16
 * Time: 9:58 AM
 */

namespace App\Mps\Repositories;
use Prettus\Repository\Eloquent\BaseRepository;

class UserRepository extends BaseRepository
{
    public function model() {
        return 'App\User';
    }
}