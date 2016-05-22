<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class vwOrder extends Model
{
    //
    public $incrementing = false;
    protected $table = "vw_orders";

    protected $guarded = [

        "id",
        "customer",
        "sales_rep",
        "order_status",
        "sync_status",
    ];

    public function lineItems()
    {
        return $this->hasMany('App\vwOrderDetail','order_id');
    }

    public static function OrdersByStatus()
    {
        $query =  self::whereBetween('date' ,[self::WeekStartDate(),self::WeekEndDate()])
            ->where('order_status','draft')->get();

        return $query;
    }

    public function scopeSales($query)
    {
        return $query->where('order_status','processed');
    }
    
    public function scopeQuantity($query)
    {
        return $query->sum('total_quantity');
    }
    
    public function scopeToday($query)
    {
        $date = new Carbon();
        return $query->where('date',$date->today());
    }

    public function scopeYesterday($query)
    {
        $date = new Carbon();
        return $query->where('date',$date->yesterday());
    }
    static function WeekStartDate()
    {
        return  date("Y-m-d", strtotime('sunday last week'));
    }


    static function WeekEndDate()
    {
        return  date("Y-m-d", strtotime('saturday this week'));
    }
}
