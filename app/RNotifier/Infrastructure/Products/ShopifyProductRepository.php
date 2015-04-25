<?php namespace App\RNotifier\Infrastructure\Products;


use App\RNotifier\Domain\Products\ProductRepositoryInterface;
use App\RNotifier\Infrastructure\Shopify\ShopifyConnector;
use Illuminate\Support\Facades\Log;
use phpish\shopify;


class ShopifyProductRepository implements ProductRepositoryInterface{


    /**
     * @var ProductAdapter
     */
    private $adapter;
    /**
     * @var ProductFactory
     */
    private $factory;

    function __construct(ShopifyConnector $shopifyConnector, ProductAdapter $adapter, ProductFactory $factory)
    {
        $this->shopifyConnector = $shopifyConnector;
        $this->adapter = $adapter;
        $this->factory = $factory;
    }

    public function retrieve($options = null)
    {
        try
        {
            $result = $this->shopifyConnector->call('GET /admin/products.json', $options);

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