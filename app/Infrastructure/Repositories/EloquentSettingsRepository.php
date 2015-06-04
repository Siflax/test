<?php namespace App\Infrastructure\Repositories;


use App\Domain\InventorySettings\Setting;
use App\Domain\InventorySettings\SettingsRepositoryInterface;

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