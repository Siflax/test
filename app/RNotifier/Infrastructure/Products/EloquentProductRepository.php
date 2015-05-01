<?php namespace App\RNotifier\Infrastructure\Products;


use App\RNotifier\Domain\Products\Product;
use App\RNotifier\Domain\Products\ProductRepositoryInterface;

class EloquentProductRepository implements ProductRepositoryInterface{

    public function save($product)
    {
        $product->save();
    }

    public function retrieveById($id)
    {
        $product = Product::find($id);

        return $product;
    }

    public function retrieveAll()
    {
        $products = Product::all();

        return $products;
    }

}