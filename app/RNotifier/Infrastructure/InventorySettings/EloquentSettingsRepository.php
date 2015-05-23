<?php namespace App\RNotifier\Infrastructure\InventorySettings;


use App\RNotifier\Domain\InventorySettings\Setting;
use App\RNotifier\Domain\InventorySettings\SettingsRepositoryInterface;

class EloquentSettingsRepository implements SettingsRepositoryInterface {
    
    public function retrieveByShop($shop)
    {
        return $shop->settings()->first();
    }

    public function updateOrCreateByShop($shop, $parameters = [], $update)
    {
        $setting = $this->firstOrCreateByShop($shop, $parameters);

        $setting->fill($update);

        $setting->save();

        return $setting;
    }

    public function firstOrCreateByShop($shop, $parameters = [])
    {
        $setting = $shop->settings()->firstOrCreate($parameters);

        return $setting;
    }

}