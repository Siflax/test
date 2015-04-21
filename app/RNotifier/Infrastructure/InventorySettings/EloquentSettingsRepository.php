<?php namespace App\RNotifier\Infrastructure\InventorySettings;


use App\RNotifier\Domain\InventorySettings\SettingsRepositoryInterface;

class EloquentSettingsRepository implements SettingsRepositoryInterface {

    public function create($setting)
    {
        $setting->save();
    }
}