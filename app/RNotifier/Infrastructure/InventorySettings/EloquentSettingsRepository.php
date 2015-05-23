<?php namespace App\RNotifier\Infrastructure\InventorySettings;


use App\RNotifier\Domain\InventorySettings\Setting;
use App\RNotifier\Domain\InventorySettings\SettingsRepositoryInterface;

class EloquentSettingsRepository implements SettingsRepositoryInterface {

    public function create($setting)
    {
        $setting->save();
    }

    public function retrieveById($id)
    {
        $setting = Setting::find($id);

        return $setting;
    }

    public function retrieveByShop($shop)
    {
        return $shop->settings()->first();
    }

    public function retrieve($options)
    {
        $settings = Setting::where($options);
    }

    public function save($setting)
    {
        $setting->save();
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