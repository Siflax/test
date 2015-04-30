<?php namespace App\RNotifier\Infrastructure\Products;


use App\RNotifier\Infrastructure\Shopify\ShopifyConnector;
use phpish\shopify;


class ShopifyProductConnector extends ShopifyConnector{

    private $adapter;
    private $factory;

    function __construct(ProductAdapter $adapter, ProductFactory $factory)
    {
        $this->adapter = $adapter;
        $this->factory = $factory;
    }

    public function retrieve($options = null)
    {
        try
        {
            $result = $this->call('GET /admin/products.json', $options);

            $products = [];

            if ($result)
            {
                foreach ($result as $product)
                {
                    $products[] = $this->factory->create($product);
                }
            }

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