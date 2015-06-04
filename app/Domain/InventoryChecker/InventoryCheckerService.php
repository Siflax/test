<?php namespace App\Domain\InventoryChecker;


use App\Domain\InventorySettings\SettingsRepositoryInterface;
use App\Domain\Shops\Shop;
use App\Infrastructure\Products\ShopifyProductConnector;

class InventoryCheckerService {

    private $settingsRepository;
    private $shopifyProductConnector;

    function __construct(ShopifyProductConnector $shopifyProductConnector, SettingsRepositoryInterface $settingsRepository)
    {
        $this->settingsRepository = $settingsRepository;
        $this->shopifyProductConnector = $shopifyProductConnector;
    }

    public function check()
    {
        $products = $this->shopifyProductConnector->retrieve();

        $id = 1;

        $shop = Shop::find(1);

        $setting = $this->settingsRepository->retrieveByShop($shop);

        $globalLimit = $setting->globalLimit;

        $lowProducts = [];
        foreach ($products as $product)
        {
            if($product->hasLowInventory($globalLimit)) $lowProducts[] =  $product;
        }

        dd($lowProducts);
    }

}