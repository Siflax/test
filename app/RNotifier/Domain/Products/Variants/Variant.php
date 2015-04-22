<?php namespace App\RNotifier\Domain\Products\Variants;


class Variant {

    public $barcode;
    public $compare_at_price;
    public $created_at;
    public $fulfillment_service;
    public $grams;
    public $id;
    public $inventory_management;
    public $inventory_policy;
    public $option1;
    public $option2;
    public $option3;
    public $position;
    public $price;
    public $product_id;
    public $requires_shipping;
    public $sku;
    public $taxable;
    public $title;
    public $updated_at;
    public $inventory_quantity;
    public $old_inventory_quantity;
    public $image_id;
    public $weight;
    public $weight_unit;

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