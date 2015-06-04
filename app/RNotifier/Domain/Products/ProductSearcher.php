<?php namespace App\RNotifier\Domain\Products;


use App\Infrastructure\Products\ShopifyProductConnector;

class ProductSearcher {

    private $productRepository;
    private $shopifyProductConnector;

    function __construct(ProductRepositoryInterface $productRepository, ShopifyProductConnector $shopifyProductConnector )
    {
        $this->productRepository = $productRepository;
        $this->shopifyProductConnector = $shopifyProductConnector;
    }

    public function execute($titleSearchTerm, $shop)
    {

        $products = $this->shopifyProductConnector->retrieve([
            'fields' => 'title, id'
        ]);

        $matches = [];

        foreach ($products as $product) {
            if ($product->titleContains($titleSearchTerm)) $matches[] = $product;
        }

        $products = [];

        foreach ($matches as $match) {

            $product = $this->productRepository->firstOrNewByShop($shop, ['id' => $match->id]);

            $product = $this->shopifyProductConnector->getDetails($product);

            $products[] = $product;
        }

        return $products;
    }
}