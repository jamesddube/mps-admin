<?php
/**
 * Created by PhpStorm.
 * User: rick
 * Date: 5/18/16
 * Time: 6:37 PM
 */

namespace App\Http\Controllers;


use App\Analytics;

class AnalyticsController extends Controller
{
    
    public function Dashboard()
    {
        dd( Analytics::getTopProduct());
        
        
    }

}