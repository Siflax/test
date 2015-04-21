<?php namespace App\RNotifier\Domain\Products\Variants;


class Variant {

    private $barcode;
    private $compare_at_price;
    private $created_at;
    private $fulfillment_service;
    private $grams;
    private $id;
    private $inventory_management;
    private $inventory_policy;
    private $option1;
    private $option2;
    private $option3;
    private $position;
    private $price;
    private $product_id;
    private $requires_shipping;
    private $sku;
    private $taxable;
    private $title;
    private $updated_at;
    private $inventory_quantity;
    private $old_inventory_quantity;
    private $image_id;
    private $weight;
    private $weight_unit;

    function __construct(
       $barcode = null,
       $compare_at_price = null,
       $created_at = null,
       $fulfillment_service = null,
       $grams = null,
       $id = null,
       $inventory_management = null,
       $inventory_policy = null,
       $option1 = null,
       $option2 = null,
       $option3 = null,
       $position = null,
       $price = null,
       $product_id = null,
       $requires_shipping = null,
       $sku = null,
       $taxable = null,
       $title = null,
       $updated_at = null,
       $inventory_quantity = null,
       $old_inventory_quantity = null,
       $image_id = null,
       $weight = null,
       $weight_unit = null
    )
    {
        $this->barcode = $barcode;
        $this->compare_at_price = $compare_at_price;
        $this->created_at = $created_at;
        $this->fulfillment_service = $fulfillment_service;
        $this->grams = $grams;
        $this->id = $id;
        $this->inventory_management = $inventory_management;
        $this->inventory_policy = $inventory_policy;
        $this->option1 = $option1;
        $this->option2 = $option2;
        $this->option3 = $option3;
        $this->position = $position;
        $this->price = $price;
        $this->product_id = $product_id;
        $this->requires_shipping = $requires_shipping;
        $this->sku = $sku;
        $this->taxable = $taxable;
        $this->title = $title;
        $this->updated_at = $updated_at;
        $this->inventory_quantity = $inventory_quantity;
        $this->old_inventory_quantity = $old_inventory_quantity;
        $this->image_id = $image_id;
        $this->weight = $weight;
        $this->weight_unit = $weight_unit;
    }

}