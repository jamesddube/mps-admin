<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PromotionProduct extends Model
{
    protected $table = 'tblPromotionProducts';
    protected $connection = 'aximos';
    protected $primaryKey = 'ProductID';
}
