<?php
/**
 * Created by PhpStorm.
 * User: james
 * Date: 12/22/15
 * Time: 9:18 PM
 */

namespace App\Intersect\Api\Request;

use Illuminate\Support\Facades\DB;

 class QueryBuilder
{
    protected $query;

    protected $model;

     protected $exceptions=array('access_token','user_id');

    public function __construct($model)
    {
        $this->query = DB::table($model->getTable());
    }

    public function applyFilters($array)
    {
      if($array != null)
      {
          $this->query->select($array);
      }

    }

    public function applyParameters($array)
    {
        $params = (array_except($array,$this->exceptions));
      foreach($params as $key => $value)
      {
          //if(!array_key_exists($key,$this->exceptions))


          $this->query->where($key,$value);
      }
    }

    public function get()
    {
      return $this->query->get();
    }

}
