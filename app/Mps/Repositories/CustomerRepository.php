<?php

namespace App\Mps\Repositories;
use Prettus\Repository\Eloquent\BaseRepository;


class CustomerRepository extends BaseRepository
{
    public function model() {
        return 'App\Customer';
    }


    public function key()
    {
        return 'customers';
    }
}