<?php namespace App\Infrastructure\Repositories;


use App\Domain\Products\Product;
use App\Domain\Products\ProductRepositoryInterface;
Use App\Infrastructure\Shopify\ShopifyProductConnector;

class EloquentProductRepository implements ProductRepositoryInterface{

    private $shopifyProductConnector;

    function __construct(ShopifyProductConnector $shopifyProductConnector)
    {
        $this->shopifyProductConnector = $shopifyProductConnector;
    }

    public function retrieveById($id)
    {
        $product = Product::find($id);

        return $product;
    }

    public function retrievePaginatedByShop($shop, $withShopifyDetails = false)
    {
        $products = $shop->products()->paginate(10);

        if ($withShopifyDetails === true)  return $this->shopifyProductConnector->addDetails($products);//$products = $this->getShopifyDetails($products);

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

    public function firstOrNewByShop($shop, $parameters = [])
    {
        return $shop->products()->firstOrNew($parameters);
    }

}