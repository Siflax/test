<?php namespace App\Infrastructure\Repositories;


use App\Domain\Shops\Shop;
use App\Domain\Shops\ShopRepositoryInterface;

class EloquentShopRepository implements ShopRepositoryInterface {

    public function firstOrCreate($attributes)
    {
        return Shop::firstOrCreate($attributes);
    }
}