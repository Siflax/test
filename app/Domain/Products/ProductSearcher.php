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

    public function execute($titleSearchTerm, $shop, $addVariants = false)
    {

        $products = $this->shopifyProductConnector->retrieve([
            'fields' => 'title, id'
        ]);

        $matches = [];

        foreach ($products as $product) {
            if ($product->titleContains($titleSearchTerm))
            {
                $match = $this->productRepository->firstOrNewByShop($shop, ['id' => $product->id]);
                $match->title = $product->title;
                $matches[] = $match;
            }
        }

        if ($addVariants) return $this->shopifyProductConnector->addVariants($matches);

        return $matches;
    }
}