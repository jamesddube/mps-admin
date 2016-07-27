<?php

namespace App\Mps\Repositories;
use App\Mps\Traits\SyncableTrait;
use Prettus\Repository\Eloquent\BaseRepository;


class CustomerRepository extends BaseRepository
{
    
    use SyncableTrait;
    
    public function model() {
        return 'App\Customer';
    }


    public function key()
    {
        return 'customers';
    }

    /** @return BaseRepository */
    public function repo()
    {
        return $this;
    }
}