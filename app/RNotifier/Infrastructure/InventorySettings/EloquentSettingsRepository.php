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

    public function retrieve($options)
    {
        $settings = Setting::where($options);
    }

    public function save($setting)
    {
        $setting->save();
    }

}