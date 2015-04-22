<?php namespace App\RNotifier\Domain\InventoryChecker;


use App\RNotifier\Domain\InventorySettings\SettingsRepositoryInterface;
use App\RNotifier\Domain\Products\ProductRepositoryInterface;

class InventoryCheckerService {

    private $productRepository;
    private $settingsRepository;

    function __construct(ProductRepositoryInterface $productRepository, SettingsRepositoryInterface $settingsRepository)
    {

        $this->productRepository = $productRepository;
        $this->settingsRepository = $settingsRepository;
    }

    public function check()
    {
        $products = $this->productRepository->retrieve();

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