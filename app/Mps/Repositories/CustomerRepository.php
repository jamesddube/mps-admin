<?php

namespace App\Mps\Repositories;
use Bosnadev\Repositories\Eloquent\Repository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class CustomerRepository extends Repository
{
    public function model() {
        return 'App\Customer';
    }


    public function key()
    {
        return 'customers';
    }
}