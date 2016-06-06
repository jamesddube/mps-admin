<?php
/**
 * Created by PhpStorm.
 * User: rick
 * Date: 5/18/16
 * Time: 6:38 PM
 */

namespace App;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class Analytics
{
    protected static $date;

    public static function date()
    {
        if(self::$date == null){ self::$date = new Carbon(); }
        return self::$date;
    }

    static function getDate(Carbon $date = null)
    {
        if(is_null($date)){ return self::date()->today();}
        return $date;
    }
    static function getWeekStartDate()
    {}
    
    static function getWeekEndDate()
    {}
    
    static function getMonthStartDate()
    {}
    
    static function getMonthEndDate()
    {}
    
    static function getYearStartDate()
    {}
    
    static function getYearEndDate()
    {}
    
    static function getDailySales()
    {}

    /**
     * @param Carbon|null $date
     * @return Collection
     */
    static function getDailyOrders(Carbon $date = null)
    {
        $date = self::getDate($date);
        $orders =  vwOrder::where('date','=',$date)->get();

        return $orders;
    }
    
    static function getWeeklySales()
    {}
    
    static function getWeeklyOrders()
    {}
    
    static function getYearlySales()
    {}
    
    static function getYearlyOrders()
    {}

    /**
     * @return vwOrderDetail Product
     */
    static function getTopProduct()
    {
        $total = DB::table('vw_order_details')
            ->groupBy('description')
            ->select(DB::raw('sum(quantity) as quantity, description'))
            ->orderBy('quantity','desc')
            ->first();
        return $total;
    }

    /**
     * @param $column
     * @param Carbon|null $date
     * @return vwOrderDetail
     * @throws \Exception
     */
    static function getTotalQuantityBy($column, Carbon $date= null)
    {
        $date = self::getDate($date);
        if(!in_array($column,['quantity','description'])){ throw new \Exception ("Invalid column $column");}
        $total = DB::table('vw_order_details')
            ->groupBy($column)
            ->where('date',$date)
            ->orderBy('aggregate','desc')
            ->sum('quantity');
        
        return $total;
    }
    
    
    
    
    
}