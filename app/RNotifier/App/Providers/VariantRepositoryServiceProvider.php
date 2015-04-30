<?php namespace App\RNotifier\App\Providers;


use Illuminate\Support\ServiceProvider;

class VariantRepositoryServiceProvider extends ServiceProvider{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\RNotifier\Domain\Products\Variants\VariantRepositoryInterface',
            'App\RNotifier\Infrastructure\Products\Variants\EloquentVariantRepository'
        );
    }
}