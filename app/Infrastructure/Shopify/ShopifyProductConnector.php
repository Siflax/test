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

        if (empty($ids)) return $products;

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

    public function addVariants($products)
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
                $ids = [];

                if ($product->variants)
                {
                    foreach ($product->variants as $variant )
                    {
                        $ids[] = $variant->id;

                        foreach ($result['variants'] as $variantResult)
                        {
                            if ($variant->id == $variantResult['id'])
                            {
                                $variant->inventory_quantity = $variantResult['inventory_quantity'];
                                $variant->title = $variantResult['title'];
                                $variant->inventory_management = $variantResult['inventory_management'];
                            }
                        }
                    }
                }


                foreach ($result['variants'] as $variantResult)
                {
                    if ( ! in_array($variantResult['id'], $ids))
                    {
                        $variant = $this->variantFactory->create([
                            'id' => $variantResult['id'],
                            'product_id' => $product->id,
                            'inventory_quantity' => $variantResult['inventory_quantity'],
                            'title' => $variantResult['title'],
                            'inventory_management' => $variantResult['inventory_management'],
                            'track' => True
                        ]);

                        $product->variants[]= $variant;
                    }
                }


            }
        }

        return $products;
    }

    public function getVariantsDetails($variants)
    {
        $productIds = [];

        foreach ($variants as $variant)
        {
            if (! in_array($variant->product_id, $productIds)) $productIds[] = $variant->product_id;
        }

        if (empty($productIds)) return $variants;

        $ids = implode(', ', $productIds);

        $results = $this->call('GET /admin/products.json', ['ids' => $ids]);

        foreach($results as $result)
        {
            foreach ($result['variants'] as $variantResult)
            {
                foreach ($variants as &$variant)
                {
                    if ($variantResult['id'] == $variant->id)
                    {
                        $variant->title = $variantResult['title'];
                        $variant->inventory_quantity = $variantResult['inventory_quantity'];
                        $variant->inventory_management = $variantResult['inventory_management'];
                        $variant->product_title = $result['title'];
                    }
                }
            }
        }

        return $variants;

    }

    public function retrieveAll($options = [])
    {

        $count = $this->call('GET /admin/products/count.json');

        $limit = 50;

        $pages = (int) ceil($count / $limit);

        $results = [];

        for($i = 1; $i <= $pages; $i ++)
        {
            $result =  $this->retrieve( $options + [
                    'limit' => $limit,
                    'page' => $i
                ], false
            );

            $results = array_merge($results, $result);
        }

        $products = $this->instanciateProducts($results);

        return $products;

    }

    public function retrieve($options = null, $instantiateProducts = true)
    {
        try
        {
            $result = $this->call('GET /admin/products.json', $options);

            if (! $instantiateProducts) return $result;

            $products = $this->instanciateProducts($result);

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

    /**
     * @param $result
     * @return array
     */
    private function instanciateProducts($result)
    {
        $products = [];

        if ($result) {
            foreach ($result as $product) {
                $products[] = $this->factory->create($product);
            }
            return $products;
        }
        return $products;
    }


}