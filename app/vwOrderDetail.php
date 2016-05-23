<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vwOrderDetail extends Model
{
    //

    protected $table = "vw_order_details";

    public function order()
    {
        return $this->belongsTo('App\vwOrder','order_id');
    }
}
