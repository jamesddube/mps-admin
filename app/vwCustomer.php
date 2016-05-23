<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vwCustomer extends Model
{
    //

	public function orders()
	{
		return $this->hasMany('App\vwOrder','customer','name');
	}

	public function recentOrders()
	{
		return $this->orders()->orderBy('date')->limit(5);
	}
}
