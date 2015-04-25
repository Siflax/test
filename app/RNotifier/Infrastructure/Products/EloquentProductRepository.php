<?php namespace App\RNotifier\Infrastructure\Products;


class EloquentProductRepository {

    public function save($product)
    {
        $product->save();
    }

}