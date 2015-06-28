<?php namespace App\Domain\Products\Variants;


use Illuminate\Database\Eloquent\Model;


class Variant extends Model
{

    protected $fillable = ['id', 'shop_id', 'product_id', 'inventory_quantity', 'title', 'inventory_management', 'inventory_limit', 'track', 'product_title'];

    public function product()
    {
        return $this->belongsTo('App\Domain\Products\Product');
    }

    public function shop()
    {
        return $this->belongsTo('App\Domain\Shops\Shop');
    }

    public function setTitleAttribute($value)
    {
        if ($value === "Default Title") $this->attributes['title'] = 'N/A';
        else $this->attributes['title'] = $value;
    }

}