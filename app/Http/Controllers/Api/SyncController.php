<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Intersect\Api;
use App\Order;
use App\OrderDetail;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class SyncController extends Controller
{
    /**
     *  Checks for new or updated Models. Just pass in the model
     *  and the last time you updated. The Sync Manager will then check
     *  the database for models created/updated after your your last sync
     *
     *  @param Model $model
     */
    public function getUpdated()
    {
        $date = new Carbon();
        return Order::Unsynced($date)->get();

        dd($date);

        return Order::where('updated_at','>',$date)->get();
    }
}
