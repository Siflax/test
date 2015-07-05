<?php namespace App\Domain\InventorySettings;


Interface SettingsRepositoryInterface {

    public function retrieveByShop($shop);

    public function updateOrCreateByShop($shop, $parameters = [], $update);

    public function firstOrCreateByShop($shop, $parameters = []);

    public function firstOrNewByShop($shop);

}