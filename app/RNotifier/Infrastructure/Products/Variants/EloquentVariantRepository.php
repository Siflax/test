<?php namespace App\RNotifier\Infrastructure\Products\Variants;


use App\RNotifier\Domain\Products\Variants\VariantRepositoryInterface;

class EloquentVariantRepository implements VariantRepositoryInterface{

    public function firstOrNewByProduct($product, $parameters = [])
    {
        return $product->variants()->firstOrNew($parameters);
    }
}