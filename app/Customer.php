<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $appends = ['customer_type','customer_status'];
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


    public function getCustomerTypeAttribute()
    {
        return $this->attributes['customer_type_id'] < 3 ? 'Retailer' : "Wholesaler" ;
    }

    public function getCustomerStatusAttribute()
    {
        if($this->attributes['customer_status_id'] == 1 )
        {
            return 'Active';
        }
        elseif ($this->attributes['customer_status_id'] == 2 )
        {
            return 'Inactive';
        }
        else
        {
            return 'Blacklisted';
        }
    }


}
