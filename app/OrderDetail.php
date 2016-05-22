<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    public $incrementing = false;
    protected $fillable = [
        "id",
        "order_id",
        "product_id",
        "quantity",
    ];



}
