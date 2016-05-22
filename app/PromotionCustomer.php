<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PromotionCustomer extends Model
{
    protected $table = 'tblPromotionCustomers';
    protected $primaryKey = 'CustomerID';
    protected $connection = 'aximos';

}
