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
        $products = Product::all();

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

}