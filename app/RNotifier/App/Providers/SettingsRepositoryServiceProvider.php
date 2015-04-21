<?php namespace App\RNotifier\App\Providers;


use Illuminate\Support\ServiceProvider;

class SettingsRepositoryServiceProvider extends ServiceProvider {

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\RNotifier\Domain\InventorySettings\SettingsRepositoryInterface',
            'App\RNotifier\Infrastructure\InventorySettings\EloquentSettingsRepository'
        );
    }
}