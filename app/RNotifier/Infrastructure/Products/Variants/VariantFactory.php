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


    public function create(Array $attributes)
    {
        //$attributes = $this->setMissingAttributesToNull($this->attributeNames, $attributes);

        $variant = new Variant($attributes);

        return $variant;
    }

}