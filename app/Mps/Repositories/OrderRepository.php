<?php
/**
 * Created by PhpStorm.
 * User: rick
 * Date: 6/2/16
 * Time: 2:24 PM
 */

namespace App\Mps\Repositories;


use Bosnadev\Repositories\Eloquent\Repository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class OrderRepository extends Repository
{

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return 'App\Order';
    }

    public static function storeBatch(array $items)
    {
        $now = Carbon::now();
        $items = collect($items)->map(function (array $data) use ($now) {
            return array_merge([
                'created_at' => $now,
                'updated_at' => $now,
            ], $data);
        })->all();

        return DB::table('orders')->insert($items);
    }
    
    public function getByOrderId($id)
    {
        return $this->findWhere(['order_id' => $id]);
    }
}