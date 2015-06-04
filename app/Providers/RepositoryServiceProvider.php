<?php namespace App\Providers;

use App\RNotifier\App\Providers\EmailRepositoryServiceProvider;
use App\RNotifier\Domain\Emails\EmailRepositoryInterface;
use App\RNotifier\Domain\InventorySettings\SettingsRepositoryInterface;
use App\RNotifier\Domain\Products\ProductRepositoryInterface;
use App\RNotifier\Domain\Products\Variants\VariantRepositoryInterface;
use App\RNotifier\Domain\Shops\ShopRepositoryInterface;
use App\Infrastructure\Emails\EloquentEmailRepository;
use App\Infrastructure\InventorySettings\EloquentSettingsRepository;
use App\Infrastructure\Products\EloquentProductRepository;
use App\Infrastructure\Products\Variants\EloquentVariantRepository;
use App\Infrastructure\Shops\EloquentShopRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		//
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{

		$this->app->bind(EmailRepositoryInterface::class, EloquentEmailRepository::class);

		$this->app->bind(ProductRepositoryInterface::class, EloquentProductRepository::class);

		$this->app->bind(SettingsRepositoryInterface::class, EloquentSettingsRepository::class);

		$this->app->bind(ShopRepositoryInterface::class, EloquentShopRepository::class);

		$this->app->bind(VariantRepositoryInterface::class, EloquentVariantRepository::class);
	}

}
