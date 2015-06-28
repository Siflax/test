<?php namespace App\Domain\Products;


use App\Domain\Shops\Shop;

interface ProductRepositoryInterface {

    public function firstOrCreateByShop($shop, $parameters = []);

    public function retrievePaginatedByShop($shop, $withShopifyDetails = false);

    public function retrieveById($id);

    public function retrieveByIdAndShop(Shop $shop, $id);
}

