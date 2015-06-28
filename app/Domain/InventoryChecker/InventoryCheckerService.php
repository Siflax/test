<?php namespace App\Domain\InventoryChecker;


use App\Domain\InventorySettings\SettingsRepositoryInterface;
use App\Domain\Products\ProductRepositoryInterface;
use App\Domain\Products\Variants\VariantRepositoryInterface;
use App\Domain\Shops\Shop;
Use App\Infrastructure\Shopify\ShopifyProductConnector;

class InventoryCheckerService {

    private $settingsRepository;
    private $shopifyProductConnector;
    private $variants;
    private $products;

    function __construct(ShopifyProductConnector $shopifyProductConnector, SettingsRepositoryInterface $settingsRepository, VariantRepositoryInterface $variants, ProductRepositoryInterface $products)
    {
        $this->settingsRepository = $settingsRepository;
        $this->shopifyProductConnector = $shopifyProductConnector;
        $this->variants = $variants;
        $this->products = $products;
    }

    public function check(Shop $shop)
    {
        $products = $this->shopifyProductConnector->retrieve();

        $notifications = [];

        $setting = $this->settingsRepository->retrieveByShop($shop);

        $counter = 0;

        foreach ($products as $index => $product)
        {

            if ( count($product['variants']) == 1) $type = 'product';
            else $type = 'variant';

            foreach ($product['variants'] as $key => $variant) {

                if ($limit = $this->checkVariant($variant, $shop, $setting))
                {
                    $notifications[$counter]['type'] = $type;
                    $notifications[$counter]['title'] = ($type === 'product') ? $product->title : $variant->title;
                    $notifications[$counter]['inventory'] = $variant->inventory_quantity;
                    $notifications[$counter]['limit'] = $limit;

                    if ($type === 'variant') $notifications[$counter]['product'] = $product->title;
                    $counter ++;
                }
            }

        }




        dd($notifications);
        // foreach product

        // if variants, foreach variants

            // if variant rule, execute

            // if product rule, execute

            // if global rule, execute

exit;

        $lowProducts = [];
        foreach ($products as $product)
        {
            if($product->hasLowInventory($globalLimit)) $lowProducts[] =  $product;
        }

        dd($lowProducts);
    }

    private function checkVariant($variant, $shop, $globalRule)
    {
        $variantRule = $this->variants->findByIdByShop($shop, $variant['id']);

        if ($variantRule)
        {
            if (! $variantRule->track) return false;
            if($variant->title === 'stor / blå')
            if ($variant->inventory_quantity < $variantRule->inventory_limit) return $variantRule->inventory_limit;
        }

        elseif ($productRule = $this->products->retrieveByIdAndShop($shop, $variant->product_id)) {

            if ($productRule)
            {
                if (! $productRule->track) return false;

                if ($variant->inventory_quantity < $productRule->inventory_limit) return $productRule->inventory_limit;
            }
        }
        else
        {
            if (! $globalRule->track) return false;
            if ($variant->inventory_quantity < $globalRule->globalLimit) return $globalRule->globalLimit;
            return false;
        }

    }


}