<?php namespace App\RNotifier\Infrastructure\Products;


use App\RNotifier\Domain\Products\Product;

class ProductFactory {

    protected $attributeNames = [
        'id',
        'createdAt',
        'handle',
        'type',
        'publishedAt',
        'publishedScope',
        'templateSuffix',
        'title',
        'updatedAt',
        'vendor',
        'tags',
        'variants',
        'options',
        'images',
        'image'
    ];

    public function create(Array $attributes)
    {

        foreach ($this->attributeNames as $name)
        {
           $attributes = $this->setMissingAttributesToNull($attributes, $name);
        }
        
        $product = new Product(
            $attributes['id'],
            $attributes['createdAt'],
            $attributes['handle'],
            $attributes['type'],
            $attributes['publishedAt'],
            $attributes['publishedScope '],
            $attributes['templateSuffix'],
            $attributes['title'],
            $attributes['updatedAt'],
            $attributes['vendor'],
            $attributes['tags'],
            $attributes['variants'],
            $attributes['options'],
            $attributes['images'],
            $attributes['image']
        );

        return $product;
    }

    private function setMissingAttributesToNull($attributes, $name)
    {
        if (! isset($attributes[$name])) $attributes[$name] = null;

        return $attributes;
    }
}