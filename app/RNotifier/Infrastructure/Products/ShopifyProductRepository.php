<?php namespace App\RNotifier\Infrastructure\Products;


use App\RNotifier\Domain\Products\ProductRepositoryInterface;
use App\RNotifier\Infrastructure\Shopify\ShopifyConnector;
use phpish\shopify;


class ShopifyProductRepository implements ProductRepositoryInterface{


    /**
     * @var ProductAdapter
     */
    private $adapter;

    function __construct(ShopifyConnector $shopifyConnector, ProductAdapter $adapter)
    {
        $this->shopifyConnector = $shopifyConnector;
        $this->adapter = $adapter;
    }

    public function retrieve()
    {
        try
        {
            $result = $this->shopifyConnector->call('GET /admin/products.json', array('published_status'=>'published'));

            $products = [];

            if ($result)
            {
                foreach ($result as $product)
                {
                    $products[] = $this->adapter->newProductFromApi($product, __FUNCTION__);
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