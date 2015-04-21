<?php namespace App\RNotifier\Infrastructure\Factories;


class Factory {

    /**
     * Sets missing attributes to null.
     *
     * @param $attributeNames
     * @param $attributes
     * @return mixed
     */
    public function setMissingAttributesToNull($attributeNames, $attributes)
    {
        foreach ($attributeNames as $name)
        {
            if (! isset($attributes[$name])) $attributes[$name] = null;
        }

        return $attributes;
    }

}