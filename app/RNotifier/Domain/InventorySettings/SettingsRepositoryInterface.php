<?php namespace App\RNotifier\Domain\InventorySettings;


Interface SettingsRepositoryInterface {

    public function create($setting);

    public function retrieveByShop($shop);

    public function retrieve($options);

    public function save($setting);
}