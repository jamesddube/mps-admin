<?php

namespace App\Http\Controllers\Api;

use App\Customer;
use App\Intersect\Api\Support\KeyArray;
use App\Mps\Transformers\CustomerTransformer;
use App\Mps\Transformers\ProductTransformer;
use App\Mps\Transformers\StockTransformer;
use App\Mps\Transformers\WarehouseTransformer;
use App\Product;
use App\Mps\Transformers\RouteTransformer;
use App\Route;
use App\Stock;
use App\Warehouse;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Intersect\Api;
use App\Order;
use App\OrderDetail;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class SyncController extends Controller
{
    
    private  $customerTransformer;
    private  $productTransformer;
    private  $stockTransformer;
    private  $warehouseTransformer;
    private   $routeTransformer;

    /**
     * SyncController constructor.
     * @param WarehouseTransformer $warehouseTransformer
     * @param RouteTransformer $routeTransformer
     * @param CustomerTransformer $customerTransformer
     * @param ProductTransformer $productTransformer
     * @param StockTransformer $stockTransformer
     */
    public function __construct(WarehouseTransformer $warehouseTransformer,RouteTransformer $routeTransformer,CustomerTransformer $customerTransformer,ProductTransformer $productTransformer,StockTransformer $stockTransformer)
    {
        $this->customerTransformer = $customerTransformer;
        $this->productTransformer = $productTransformer;
        $this->stockTransformer = $stockTransformer;
        $this->warehouseTransformer = $warehouseTransformer;
        $this->routeTransformer = $routeTransformer;
    }

    /**
     *  Checks for new or updated Models. Just pass in the model
     *  and the last time you updated. The Sync Manager will then check
     *  the database for models created/updated after your your last sync
     *
     */


    public function hardSync()
    {
        $products = Product::all();
        $customers = Customer::all();
        $stocks = Stock::all();
        $warehouses = Warehouse::all();
        $routes = Route::all();
        //$warehouses->load('stocks.product');

        

       

        return response()->json([
                'products' => $this->productTransformer->transformCollection($products->toArray()),
                'customers'=> $this->customerTransformer->transformCollection($customers->toArray()),
                'stocks'=> $this->stockTransformer->transformCollection($stocks->toArray()),
                'warehouses' => $this->warehouseTransformer->transformCollection($warehouses->toArray()),
                'routes' => $this->routeTransformer->transformCollection($routes->toArray())
        ]);


    }
}
