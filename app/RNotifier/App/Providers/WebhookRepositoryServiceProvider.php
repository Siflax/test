<?php namespace App\RNotifier\App\Providers;


use Illuminate\Support\ServiceProvider;

class WebhookRepositoryServiceProvider extends ServiceProvider{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\RNotifier\Domain\Webhooks\WebhookRepositoryInterface',
            'App\RNotifier\Infrastructure\Webhooks\EloquentWebhookRepository'
        );
    }
}