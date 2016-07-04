<?php

namespace App;

use App\Mps\Presenters\PresentableTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class vwOrder extends Model
{
    use PresentableTrait;
    protected $presenter = 'App\Mps\Presenters\Order';
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

    protected $dates = ['date'];

    public function getDateAttribute($date)
    {
        $date = new Carbon($date);
        return $date->diffForHumans();
    }

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
        return $query->where('order_status','<>','draft');
    }
    
    public function scopeQuantity($query)
    {
        return $query->sum('total_quantity');
    }
    
    public function scopeToday($query)
    {
        $date = new Carbon();
        
        return $query->whereBetween('date',[$date->today(),$date->tomorrow()]);
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
