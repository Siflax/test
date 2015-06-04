<?php namespace App\Infrastructure\Products;


use App\Domain\Products\Product;
use App\Infrastructure\Factories\Factory;
use App\Infrastructure\Products\Variants\VariantFactory;

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
        $variants = $this->createVariants($attributes);

        $product = new Product($attributes);

        if ($variants) $product->variants = $variants;

        return $product;
    }

    private function createVariants($attributes)
    {
        $variants = [];

        if (isset($attributes['variants']) && !is_null($attributes['variants'])) {
            foreach ($attributes['variants'] as $variant) {
                $variants[] = $this->variantFactory->create($variant);
            }
        }

        if (! empty($variants)) return $variants;
        else return false;
    }

}