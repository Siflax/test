<?php namespace App\Domain\Shops;


use Illuminate\Database\Eloquent\Model;

class Shop extends Model {

    protected $fillable = ['url'];

    public function products()
    {
        return $this->hasMany('App\Domain\Products\Product');
    }

    public function emails()
    {
        return $this->hasMany('App\Domain\Emails\Email');
    }

    public function settings()
    {
        return $this->hasMany('App\Domain\InventorySettings\Setting');
    }

    public function variants()
    {
        return $this->hasManyThrough('App\Domain\Products\Variants\Variant', 'App\Domain\Products\Product');
    }

}