<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class Promotion extends Model
{

    protected $connection = 'aximos';
    protected $table = 'dbo.tblPromotions';
    protected $primaryKey = 'PromotionID';

    protected $appends = ['customers'];

    protected $visible = [
        'Title',
        'excludedCustomers',
        'StartDate',
        'EndDate',
        'DiscountRate',
        'DiscountedPrice',
        'Products',
        'customers'
    ];

    public function setDiscountedPrice()
    {
        $this->Products->each(function ($product){
            $Wdisc = (($this->DiscountRate / 100) * $product->WholesaleUnitPrice);
            $Udisc = (($this->DiscountRate / 100) * $product->UnitPrice);
            $product->DiscountedUnitPrice = round($product->UnitPrice - $Udisc,2);
            $product->DiscountedWholesaleUnitPrice = round($product->WholesaleUnitPrice - $Wdisc,2);
        });
    }

    public function getCustomerSpecificPromotions()
    {

    }

    /**
     * @return AximosCustomers[]
     */
    public function getSelectedCustomers()
    {
        $db = DB::connection('aximos');
        $results = $db->table('tblPromotions')
            ->join('tblPromotionCustomers', 'tblPromotions.PromotionID', '=', 'tblPromotionCustomers.PromotionID')
            ->join('tblCustomers', 'tblPromotionCustomers.CustomerID', '=', 'tblCustomers.CustomerID')
            ->where('tblPromotions.PromotionID', $this->getId())
            ->select('tblCustomers.*')
            ->get();

        return Collection::make($results);
    }

    public function getExcludedCustomers()
    {

    }

    /**
     * @return Promotion[]
     */
    public static function getRetailerPromotions()
    {
        $promotions = Promotion::whereIn('tblPromotions.PromotionCustomerID', [3, 7])->get();

        return $promotions;
    }

    public static function getWholesalerPromotions()
    {
        $promotions = Promotion::whereIn('PromotionCustomerID', [6, 2])->get();
        return $promotions;
    }

    public function getCustomers()
    {
        switch ($this->PromotionCustomerID) {
            case 3: {
                //return Retailers
                return Collection::make(AximosCustomers::getRetailers());
            }
            case 2: {
                //return Wholesalers
                return Collection::make(AximosCustomers::getWholesalers());
            }
            case 1: {
                //return All customers
                return AximosCustomers::all();
            }
            case 4: {
                //return Selected Customers
                return $this->getSelectedCustomers();
            }
            case 7 || 6 || 5: {
                if ($this->PromotionCustomerID) ;
                $allCustomers = $this->PromotionCustomerID = 7 ? Collection::make(AximosCustomers::getRetailers()) : $this->PromotionCustomerID = 5 ? AximosCustomers::all() : Collection::make(AximosCustomers::getWholesalers());
                $col = Collection::make($this->getSelectedCustomers());
                ($ids = ($col->pluck('CustomerID')->toArray()));
                $finalCustomers = $allCustomers->reject(function ($promo) use (&$ids) {
                    return in_array($promo->CustomerID, $ids);
                });
                return ($finalCustomers);
            }

        }


    }

    public function excludedCustomers()
    {
        return $this->hasManyThrough('App\\AximosCustomers', 'App\\PromotionCustomer', 'PromotionID', 'CustomerID');
    }

    public function Products()
    {
        return $this->hasManyThrough('App\\AximosProduct', 'App\\PromotionProduct', 'PromotionID', 'ProductID');
    }

    public function getId()
    {
        return $this->getKey();
    }

    public static function getActivePromotions()
    {

    }

    public function getDiscount()
    {

    }

    function flatten_array(array $array)
    {
        $flattened_array = array();
        array_walk_recursive($array, function ($a) use (&$flattened_array) {
            $flattened_array[] = $a;
        });
        return $flattened_array;
    }

    public function getDiscountedPrice(AximosProduct $product, $customerType)
    {
        //@todo What if a non participating product is put here?
        $price = $customerType == 'RETAILER' ? $product->UnitPrice : $product->WholesaleUnitPrice;
        $discountAmount = (($this->DiscountedRate/100) * $price);

        return  $price - $discountAmount;
    }

    public function getCustomersAttribute()
    {
        return $this->getCustomers();
    }

}
