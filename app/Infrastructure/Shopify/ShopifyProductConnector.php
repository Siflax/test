<?php namespace App\Infrastructure\Shopify;


use App\Domain\Products\Product;
use App\Domain\Products\Variants\Variant;
use App\Infrastructure\Adapters\ProductAdapter;
use App\Infrastructure\Factories\VariantFactory;
use App\Infrastructure\Factories\ProductFactory;
use App\Infrastructure\Shopify\ShopifyConnector;
use Illuminate\Database\Eloquent\Collection;
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

    public function addDetails($products)
    {
        $ids = [];

        foreach( $products as $product)
        {
            $ids[] = $product->id;
        }

        $idsString = implode(', ', $ids);

        $results = $this->call('GET /admin/products.json', ['ids' => $idsString]);

        foreach ($results as $result)
        {
            foreach ($products as &$product)
            {
                if ($product->id == $result['id']) $product->title = $result['title'];
            }
        }

        return $products;
    }

    public function getDetails(Product $product, $addOriginalVariants = true)
    {
        $id = $product->id;

        $options = [
          'ids' => $id,
        ];

        $result = $this->call('GET /admin/products.json', $options);

        $product->title = $result[0]['title'];

        if (count($result[0]['variants'])  <= 1) return $product;

        foreach ($result[0]['variants'] as $variantAttributes) {

            $ids = [];


            if ($product->variants)
            {
                foreach ($product->variants as $variant )
                {
                    $ids[] = $variant->id;

                    if ($variant->id == $variantAttributes['id'])
                    {
                        $variant->inventory_quantity = $variantAttributes['inventory_quantity'];
                        $variant->title = $variantAttributes['title'];
                        $variant->inventory_management = $variantAttributes['inventory_management'];
                    }
                }
            }


            if ($addOriginalVariants)
            {
                if ( ! in_array($variantAttributes['id'], $ids))
                {
                    $variant = $this->variantFactory->create([
                        'id' => $variantAttributes['id'],
                        'product_id' => $product->id,
                        'inventory_quantity' => $variantAttributes['inventory_quantity'],
                        'title' => $variantAttributes['title'],
                        'inventory_management' => $variantAttributes['inventory_management'],
                        'track' => True
                    ]);

                    $product->variants[]= $variant;
                }
            }
        }

        return $product;
    }

    public function getVariantDetails(Variant $variant)
    {

        $result = $this->call('GET /admin/products.json', ['ids' => $variant->product_id]);

        foreach ($result as $productDetails)
        {

            foreach ($productDetails['variants'] as $variantDetails)
            {
                if ($variantDetails['id'] == $variant->id)
                {
                    $variant->title = $variantDetails['title'];
                    $variant->inventory_quantity = $variantDetails['inventory_quantity'];
                    $variant->inventory_management = $variantDetails['inventory_management'];
                    $variant->product_title = $productDetails['title'];
                }
            }
        }

        return $variant;
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