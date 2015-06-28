<?php namespace App\Domain\Products\Variants;


use App\Domain\Shops\Shop;

interface VariantRepositoryInterface {

    public function updateOrCreateByShop($shop, $parameters = [], $update);

    public function firstOrCreateByShop(Shop $shop, $parameters = []);

    public function firstOrNewByShop(Shop $shop, $parameters = []);

}
