<?php namespace App\Infrastructure\Repositories;


use App\Domain\Shops\Shop;
use App\Domain\SubscriptionPlans\SubscriptionPlan;
use App\Domain\SubscriptionPlans\SubscriptionPlanRepository;
use App\Infrastructure\Shopify\ShopifyConnector;
use Illuminate\Support\Facades\Config;

class ShopifySubscriptionPlanRepository implements SubscriptionPlanRepository {

    private $shopifyConnector;

    function __construct(ShopifyConnector $shopifyConnector)
    {
        $this->shopifyConnector = $shopifyConnector;
    }

    public function getForShop()
    {
        $results = $this->shopifyConnector->call('GET /admin/recurring_application_charges.json');

        $subscriptionPlans = [];

        foreach ($results as $result )
        {
            $subscriptionPlans[] = new SubscriptionPlan($result);
        }

        return $subscriptionPlans;
    }

    public function shopIsSubscribed()
    {
        $subscriptionPlans = $this->getForShop();

        foreach ($subscriptionPlans as $subscriptionPlan)
        {
            if ( $subscriptionPlan->isActive() ) return true;
        }

        return false;
    }

    public function createForShop()
    {
        $options = [
            "recurring_application_charge" => Config::get('RNotifier.subscriptionPlans')
        ];

        $result = $this->shopifyConnector->call('POST /admin/recurring_application_charges.json', $options);

        return new SubscriptionPlan($result);

    }

    public function activateForShop($id)
    {
        $this->shopifyConnector->call('POST /admin/recurring_application_charges/' . $id . '/activate.json');
    }
}