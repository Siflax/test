<?php namespace App\RNotifier\App\Providers;



use Illuminate\Support\ServiceProvider;

class EmailRepositoryServiceProvider extends ServiceProvider {


    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\RNotifier\Domain\Emails\EmailRepositoryInterface',
            'App\RNotifier\Infrastructure\Email\EloquentEmailRepository'
        );
    }


}