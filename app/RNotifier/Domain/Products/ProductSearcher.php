<?php namespace App\RNotifier\Domain\Products;


use App\RNotifier\Infrastructure\Products\ShopifyProductConnector;

class ProductSearcher {

    private $productRepository;
    private $shopifyProductConnector;

    function __construct(ProductRepositoryInterface $productRepository, ShopifyProductConnector $shopifyProductConnector )
    {
        $this->productRepository = $productRepository;
        $this->shopifyProductConnector = $shopifyProductConnector;
    }

    public function execute($titleSearchTerm)
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
            $product = $this->productRepository->retrieveById($match->id);

            if (! $product) $product = $match;

            $product = $this->shopifyProductConnector->getDetails($product);

            $products[] = $product;
        }

        return $products;
    }
}