<?php namespace App\Domain\Products;


Use App\Infrastructure\Shopify\ShopifyProductConnector;

class ProductSearcher {

    private $productRepository;
    private $shopifyProductConnector;

    function __construct(ProductRepositoryInterface $productRepository, ShopifyProductConnector $shopifyProductConnector )
    {
        $this->productRepository = $productRepository;
        $this->shopifyProductConnector = $shopifyProductConnector;
    }

    public function execute($titleSearchTerm, $shop, $getDetails = true)
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

            if ($getDetails) $product = $this->shopifyProductConnector->getDetails($product);

            $products[] = $product;
        }

        return $products;
    }
}