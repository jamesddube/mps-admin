<?php
/**
 * Created by PhpStorm.
 * User: james
 * Date: 12/15/15
 * Time: 2:56 PM
 */

function startDate()
{
    return  date("Y-m-d", strtotime('sunday last week'));
}


function endDate()
{
    return  date("Y-m-d", strtotime('saturday this week'));
}