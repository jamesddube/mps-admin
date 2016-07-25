<?php
/**
 * Created by PhpStorm.
 * User: rick
 * Date: 6/2/16
 * Time: 2:24 PM
 */

namespace App\Mps\Repositories;


use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Prettus\Repository\Eloquent\BaseRepository;

class OrderRepository extends BaseRepository
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