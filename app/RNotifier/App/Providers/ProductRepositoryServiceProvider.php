<?php namespace App\RNotifier\App\Providers;


use Illuminate\Support\ServiceProvider;

class ProductRepositoryServiceProvider extends ServiceProvider {

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\RNotifier\Domain\Products\ProductRepositoryInterface',
            'App\RNotifier\Infrastructure\Products\ShopifyProductRepository'
        );
    }
}