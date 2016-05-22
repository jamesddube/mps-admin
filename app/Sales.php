<?php
/**
 * Created by PhpStorm.
 * User: james
 * Date: 2/8/16
 * Time: 7:37 PM
 */

namespace App;

use App\HelperFunctions;
use Illuminate\Support\Facades\DB;


class Sales
{
    public static function getSalesByCategory($category , $startDate = null , $endDate = null)
    {
        //$startDate = is_null($startDate) ? StartDate() : $startDate;

        //$endDate = is_null($endDate) ? StartDate() : $endDate;

        $model = vwOrder::where('order_status','processed')
            ->groupBy($category)
            ->get();

        $sql = DB::table('vw_orders')->where('order_status','processed')
                                    ->select($category,DB::raw('sum(total_price) as `sales`'))
                                    ->groupBy($category)
                                    ->get();

        return $model;

    }

    public static function topSalesByCategory()
    {

    }
}