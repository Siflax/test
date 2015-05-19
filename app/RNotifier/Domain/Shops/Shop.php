<?php namespace App\RNotifier\Domain\Shops;


use Illuminate\Database\Eloquent\Model;

class Shop extends Model {

    protected $fillable = ['url'];

    public function products()
    {
        return $this->hasMany('App\RNotifier\Domain\Products\Product');
    }

    public function emails()
    {
        return $this->hasMany('App\RNotifier\Domain\Emails\Email');
    }

    public function settings()
    {
        return $this->hasMany('App\RNotifier\Domain\InventorySettings\Settings');
    }

}