<?php namespace App\RNotifier\Domain\InventorySettings;


Interface SettingsRepositoryInterface {

    public function retrieveByShop($shop);

    public function updateOrCreateByShop($shop, $parameters = [], $update);

    public function firstOrCreateByShop($shop, $parameters = []);

}