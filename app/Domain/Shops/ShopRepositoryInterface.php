<?php namespace App\Domain\Shops;


interface ShopRepositoryInterface {

    public function firstOrCreate($attributes);
}