<?php namespace App\RNotifier\Infrastructure\Products;


use App\RNotifier\Domain\Products\ProductRepositoryInterface;
use App\RNotifier\Infrastructure\Shopify\ShopifyConnector;
use phpish\shopify;


class ShopifyProductRepository implements ProductRepositoryInterface{


    function __construct(ShopifyConnector $shopifyConnector)
    {
        $this->shopifyConnector = $shopifyConnector;
    }

    public function get()
    {
        try
        {
            $products = $this->shopifyConnector->call('GET /admin/products.json', array('published_status'=>'published'));

            return $products;
        }
        catch (shopify\ApiException $e)
        {
            # HTTP status code was >= 400 or response contained the key 'errors'
            echo $e;
            print_R($e->getRequest());
            print_R($e->getResponse());
        }
        catch (shopify\CurlException $e)
        {
            # cURL error
            echo $e;
            print_R($e->getRequest());
            print_R($e->getResponse());
        }
    }

}