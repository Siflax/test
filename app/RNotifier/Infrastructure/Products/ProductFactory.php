<?php namespace App\RNotifier\Infrastructure\Products;


use App\RNotifier\Domain\Products\Product;
use App\RNotifier\Infrastructure\Factories\Factory;
use App\RNotifier\Infrastructure\Products\Variants\VariantFactory;

class ProductFactory extends Factory
{

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

    private $variantFactory;

    function __construct(VariantFactory $variantFactory)
    {
        $this->variantFactory = $variantFactory;
    }

    /**
     * Takes an array of attributes and assigns them to the new object
     *
     * @param array $attributes
     * @return Product
     */
    public function create(Array $attributes)
    {
        $attributes = $this->setMissingAttributesToNull($this->attributeNames, $attributes);

        $variants = $this->createVariants($attributes['variants']);
        
        $product = new Product(
            $attributes['id'],
            $attributes['createdAt'],
            $attributes['handle'],
            $attributes['type'],
            $attributes['publishedAt'],
            $attributes['publishedScope'],
            $attributes['templateSuffix'],
            $attributes['title'],
            $attributes['updatedAt'],
            $attributes['vendor'],
            $attributes['tags'],
            $variants,
            $attributes['options'],
            $attributes['images'],
            $attributes['image']
        );

        return $product;
    }

    private function createVariants($variantsAttributes)
    {
        if ($variantsAttributes)
        {
            $variants = [];

            foreach($variantsAttributes as $variantAttributes)
            {
                $variants[] = $this->variantFactory->create($variantAttributes);
            }

            return $variants;
        }
    }
}