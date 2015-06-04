<?php namespace App\Infrastructure\Shopify;


use Illuminate\Support\Facades\Config;
use phpish\shopify;

class ShopifyConnector {


    private function connect()
    {
        $apiKey = Config::get('RNotifier.apiKey');
        $password = Config::get('RNotifier.password');
        $shopName = Config::get('RNotifier.shopName');

        $shopify = shopify\client($shopName, $apiKey, $password, true);

        return $shopify;
    }

    public function call($method, $options = [])
    {
        $shopify = $this->connect();

        $result = $shopify($method, $options);

        return $result;
    }

}