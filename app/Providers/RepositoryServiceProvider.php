<?php namespace App\Providers;

use App\Domain\Emails\EmailRepositoryInterface;
use App\Domain\InventorySettings\SettingsRepositoryInterface;
use App\Domain\Products\ProductRepositoryInterface;
use App\Domain\Products\Variants\VariantRepositoryInterface;
use App\Domain\Shops\ShopRepositoryInterface;
use App\Infrastructure\Repositories\EloquentEmailRepository;
use App\Infrastructure\Repositories\EloquentSettingsRepository;
use App\Infrastructure\Repositories\EloquentProductRepository;
use App\Infrastructure\Repositories\EloquentVariantRepository;
use App\Infrastructure\Repositories\EloquentShopRepository;
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
