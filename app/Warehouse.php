<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    public function stocks()
    {
        return $this->hasMany('App\Stock');
    }
}
