<?php namespace App\RNotifier\Infrastructure\Products;


use App\RNotifier\Domain\Products\Product;
use App\RNotifier\Infrastructure\Products\Variants\VariantFactory;
use App\RNotifier\Infrastructure\Shopify\ShopifyConnector;
use phpish\shopify;


class ShopifyProductConnector extends ShopifyConnector{

    private $adapter;
    private $factory;
    private $variantFactory;

    function __construct(ProductAdapter $adapter, ProductFactory $factory, VariantFactory $variantFactory)
    {
        $this->adapter = $adapter;
        $this->factory = $factory;
        $this->variantFactory = $variantFactory;
    }

    public function getDetails(Product $product)
    {
        $id = $product->id;

        $options = [
          'ids' => $id,
        ];

        $result = $this->call('GET /admin/products.json', $options);

        $product->title = $result[0]['title'];

        $variants = [];

        foreach ($result[0]['variants'] as $variantAttributes) {

            foreach ($product->variants as $variant )
            {
                if ($variant->id == $variantAttributes['id'])
                {
                    $variant->inventory_quantity = $variantAttributes['inventory_quantity'];
                    $variant->title = $variantAttributes['title'];
                    $variant->inventory_management = $variantAttributes['inventory_management'];
                }
                else $variant = $this->variantFactory->create($variantAttributes);

                $variants[] = $variant;
            }

            $product->variants = $variants;
        }

        return $product;
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