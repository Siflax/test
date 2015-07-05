<?php namespace App\Infrastructure\Shopify;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use phpish\shopify;

class ShopifyConnector {


    private function connect()
    {
        $shop = Auth::user();
        $apiKey = Config::get('RNotifier.apiKey');

        $shopify = shopify\client($shop->url, $apiKey, $shop->remember_token);

        return $shopify;
    }

    public function call($method, $options = [])
    {
        $shopify = $this->connect();

        $result = $shopify($method, $options);

        return $result;
    }

}