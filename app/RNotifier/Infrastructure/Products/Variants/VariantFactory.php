<?php
/**
 * Created by PhpStorm.
 * User: Simon
 * Date: 21/04/15
 * Time: 14.24
 */

namespace App\RNotifier\Infrastructure\Products\Variants;


use App\RNotifier\Domain\Products\Variants\Variant;
use App\RNotifier\Infrastructure\Factories\Factory;

class VariantFactory extends Factory {

    protected $attributeNames = [
        "barcode",
        "compare_at_price",
        "created_at",
        "fulfillment_service",
        "grams",
        "id",
        "inventory_management",
        "inventory_policy",
        "option1",
        "option2",
        "option3",
        "position",
        "price",
        "product_id",
        "requires_shipping",
        "sku",
        "taxable",
        "title",
        "updated_at",
        "inventory_quantity",
        "old_inventory_quantity",
        "image_id",
        "weight",
        "weight_unit",
    ];

    /**
     * Takes an array of attributes and assigns them to the new object
     *
     * @param array $attributes
     * @return Product
     */
    public function create(Array $attributes)
    {
        $attributes = $this->setMissingAttributesToNull($this->attributeNames, $attributes);

        $variant = new Variant(
            $attributes["barcode"],
            $attributes["compare_at_price"],
            $attributes["created_at"],
            $attributes["fulfillment_service"],
            $attributes["grams"],
            $attributes["id"],
            $attributes["inventory_management"],
            $attributes["inventory_policy"],
            $attributes["option1"],
            $attributes["option2"],
            $attributes["option3"],
            $attributes["position"],
            $attributes["price"],
            $attributes["product_id"],
            $attributes["requires_shipping"],
            $attributes["sku"],
            $attributes["taxable"],
            $attributes["title"],
            $attributes["updated_at"],
            $attributes["inventory_quantity"],
            $attributes["old_inventory_quantity"],
            $attributes["image_id"],
            $attributes["weight"],
            $attributes["weight_unit"]
        );

        return $variant;
    }

}