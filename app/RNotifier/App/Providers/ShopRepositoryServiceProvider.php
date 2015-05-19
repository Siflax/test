<?php namespace App\RNotifier\App\Providers;


use Illuminate\Support\ServiceProvider;

class ShopRepositoryServiceProvider extends ServiceProvider{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\RNotifier\Domain\Shops\ShopRepositoryInterface',
            'App\RNotifier\Infrastructure\Shops\EloquentShopRepository'
        );
    }

}