<?php namespace App\RNotifier\Infrastructure\Products;


use App\RNotifier\Domain\Products\Product;
use App\RNotifier\Domain\Products\Variants\Variant;

class EloquentProductRepository {

    public function save($product)
    {
        $product->save();
    }

    public function retrieveById($id)
    {
        $product = Product::find($id);

        return $product;
    }

}