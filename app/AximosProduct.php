<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AximosProduct extends Model
{
    protected $table = 'tblProducts';
    protected $connection = 'aximos';
    protected $primaryKey = 'ProductID';

    protected $visible = [
        'ProductID',
        'Code',
        'Description',
        'UnitPrice',
        'WholesaleUnitPrice',
        'ProductCategoryID',
        'DiscountedUnitPrice',
        'DiscountedWholesaleUnitPrice',
    ];
    
}
