<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //
    protected $fillable =
        [
            'id' ,
            'name' ,
            'vat_number' ,
            'address' ,
            'telephone' ,
            'fax' ,
            'email' ,
            'contact_person' ,
            'contact_position' ,
            'contact_cell' ,
            'customer_status_id',
            'customer_type_id'
        ];

    public $incrementing = false;

        public function orders()
        {
            return $this->hasMany('App\Order');
        }

        public function recentOrders()
        {
            return $this->orders()->orderBy('order_date')->limit(5);
        }


}
