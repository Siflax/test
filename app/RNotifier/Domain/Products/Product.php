<?php namespace App\RNotifier\Domain\Products;


use Illuminate\Database\Eloquent\Model;

class Product extends Model  {

        protected $fillable = ['id', 'title', 'inventory_limit', 'track'];


        public function hasLowInventory($globalLimit)
        {
            if ($this->variants[0]->inventory_quantity < $globalLimit && $this->isManagedByShopify()) return true;
            else return false;
        }

        public function titleContains($searchTerm)
        {
            $searchTerm = strtolower($searchTerm);
            $title = strtolower($this->title);

            if (strpos($title,$searchTerm) !== false) return true;
            else return false;
        }

        private function isManagedByShopify()
        {
            if ($this->variants[0]->inventory_management == "shopify") return true;
            else return false;
        }

        public function variants()
        {
            return $this->hasMany('App\RNotifier\Domain\Products\Variants\Variant');
        }

        public function shop()
        {
            $this->belongsTo('App\RNotifier\Domain\Shops\Shop');
        }


}
