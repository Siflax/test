<?php namespace App\RNotifier\Infrastructure\Products;


use App\RNotifier\Domain\Products\Product;
use App\RNotifier\Domain\Products\ProductRepositoryInterface;

class EloquentProductRepository implements ProductRepositoryInterface{

    private $shopifyProductConnector;

    function __construct(ShopifyProductConnector $shopifyProductConnector)
    {
        $this->shopifyProductConnector = $shopifyProductConnector;
    }

    public function save($product)
    {
        $product->save();
    }

    public function retrieveById($id)
    {
        $product = Product::find($id);

        return $product;
    }

    public function retrieveAll($withShopifyDetails = false)
    {
        $products = Product::paginate(10);

        if ($withShopifyDetails === false) return $products;
        elseif ($withShopifyDetails === true) {

            $detailedProducts = [];

            foreach ($products as $product)
            {
                $detailedProducts[] = $this->shopifyProductConnector->getDetails($product);
            }
            return $detailedProducts;
        }
    }

    public function retrievePaginatedByShop($shop, $withShopifyDetails = false)
    {
        $products = $shop->products()->paginate(10);

        if ($withShopifyDetails === true) $products = $this->getShopifyDetails($products);

        return $products;
    }

    /**
     * Get a products details from shopify
     *
     * @param $products
     * @return mixed
     */
    public function getShopifyDetails($products)
    {
        foreach ($products as $key => $value) {
            $products[$key] = $this->shopifyProductConnector->getDetails($products[$key]);
        }
        return $products;
    }


    public function firstOrCreateByShop($shop, $parameters = [])
    {
        return $shop->products()->firstOrCreate($parameters);
    }

}