<?php namespace App\Infrastructure\Transformers;


class Translator {

    /**
     * Translates the keys of an an array.
     * It uses a key-value dictionary to translate the original arrays key names.
     *
     * @param $originalArray   array with keys to be translated
     * @param $dictionary     array with keys to be translated to values. (it translates a key name to the corresponding value)
     * @return array
     */


    public function translate($originalArray, $dictionary)
    {
        $translatedArray = [];

        foreach ($dictionary as $key => $value) {
            if (isset($originalArray[$key]) && ! is_null($originalArray[$key])) {
                $translatedArray[$value] = $originalArray[$key];
            }
        }

        return $translatedArray;
    }

}