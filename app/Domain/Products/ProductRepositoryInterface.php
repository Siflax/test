<?php namespace App\Domain\Products;


interface ProductRepositoryInterface {

    public function firstOrCreateByShop($shop, $parameters = []);

    public function retrievePaginatedByShop($shop, $withShopifyDetails = false);

    public function retrieveById($id);
}

