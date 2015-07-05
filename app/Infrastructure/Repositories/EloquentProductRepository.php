<?php namespace App\Infrastructure\Repositories;


use App\Domain\Products\Product;
use App\Domain\Products\ProductRepositoryInterface;
use App\Domain\Shops\Shop;
Use App\Infrastructure\Shopify\ShopifyProductConnector;
use Illuminate\Support\Facades\Input;

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

    public function retrieveByIdAndShop(Shop $shop, $id)
    {
        return $shop->products()->find($id);
    }

    public function retrievePaginatedByShop($shop, $withShopifyDetails = false)
    {
        $products = $shop->products()->paginate(5);

        $products->appends(Input::except('page'));

        if ($withShopifyDetails === true)  return $this->shopifyProductConnector->addDetails($products);

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