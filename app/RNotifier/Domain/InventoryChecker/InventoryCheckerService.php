<?php namespace App\RNotifier\Domain\InventoryChecker;


use App\RNotifier\Domain\InventorySettings\SettingsRepositoryInterface;
use App\RNotifier\Infrastructure\Products\ShopifyProductConnector;

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

        $setting = $this->settingsRepository->retrieveById($id);

        $globalLimit = $setting->globalLimit;

        $lowProducts = [];
        foreach ($products as $product)
        {
            if($product->hasLowInventory($globalLimit)) $lowProducts[] =  $product;
        }

        dd($lowProducts);
    }

}