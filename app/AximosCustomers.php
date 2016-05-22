<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

/**
 * Created by PhpStorm.
 * User: rick
 * Date: 5/17/16
 * Time: 9:47 AM
 */
class AximosCustomers extends Model
{
    protected $connection = 'aximos';
    protected $table = 'tblCustomers';
    protected $primaryKey = 'CustomerID';

    protected $visible = [
        'CustomerID',
        'CustomerNumber',
        'CustomerName',
        'Address',
        'CustomerType',
        'PaymentMethod'
    ];

    public static function getRetailers()
    {
        return AximosCustomers::where('CustomerType','Retailer')->get();
    }

    public static function getWholesalers()
    {
        return AximosCustomers::where('CustomerType','Wholesaler')->get();
    }

    public function getActivePromotions()
    {
        $promos = Promotion::getRetailerPromotions();
        
        return ($promos);
    }
    
    public function getPromotions()
    {
        /** @var \Illuminate\Database\Eloquent\Collection $promos */
        $promos = \App\Promotion::getRetailerPromotions();
        
        $elligiblePromotions = $promos->reject(function($promo){
            /** @var \App\Promotion $promo */
            $promo->load('Products');
            foreach($promo->excludedCustomers()->get() as $customer)
            {
                $promo->setDiscountedPrice();
                return ($customer->CustomerID == $this->getKey());
            }
            return false;
        });

        return ($elligiblePromotions);
    }
}