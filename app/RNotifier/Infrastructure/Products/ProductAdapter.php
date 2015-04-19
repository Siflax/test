<?php namespace App\RNotifier\Infrastructure\Products;


use App\RNotifier\Infrastructure\AntiCorruptionLayer\Adapter;

class ProductAdapter extends Adapter {

    public function newProductFromApi($attributes, $method)
    {
        $entityParameters = $this->toEntityParameters($attributes,$method);

        dd($entityParameters);
    }
}