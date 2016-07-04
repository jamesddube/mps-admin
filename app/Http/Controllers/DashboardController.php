<?php

namespace App\Http\Controllers;

use App\Analytics;
use App\Http\Requests\CreateOrderRequest;
use App\Promotion;
use App\vwOrder;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use JavaScript;
use App\Order;
use App\OrderDetail;
use App\Product;
use App\User;
use Exception;
use Illuminate\Http\Request;
use App\Http\Requests;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $today = vwOrder::Sales()->today()->Quantity();
        $yesterday = vwOrder::Sales()->Yesterday()->Quantity();
        $topProduct = Analytics::getTopProduct();
       /*JavaScript::put([
            'foo' => 'bar',
            'user' => User::first(),
            'age' => 29
        ]);*/
        if(!is_string($yesterday)){$yesterday = 0;}
        if(!is_string($today)){$today = 0;}

        return view('pages.index' , ['today' => $today,'yesterday'=>$yesterday,'topProduct'=>$topProduct]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request , $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function gen(Request $request)
    {
       return vwOrder::OrdersByStatus();
    }
}
