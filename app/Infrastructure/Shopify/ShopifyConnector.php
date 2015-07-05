<?php namespace App\Infrastructure\Shopify;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use phpish\shopify;

class ShopifyConnector {


    private function connect()
    {
        $shop = Auth::user();

        return  shopify\client($shop->url, Config::get('RNotifier.apiKey'), $shop->remember_token);
    }

    public function call($method, $options = [])
    {
        $shopify = $this->connect();

        return $shopify($method, $options);
    }

}