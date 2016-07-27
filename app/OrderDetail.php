<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderDetail extends Model
{
    use SoftDeletes;

    public $incrementing = false;
    protected $fillable = [
        "id",
        "order_id",
        "product_id",
        "quantity",
    ];



}
