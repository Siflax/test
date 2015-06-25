<?php namespace App\Domain\Products\Variants;


use Illuminate\Database\Eloquent\Model;


class Variant extends Model
{

    protected $fillable = ['id', 'product_id', 'inventory_quantity', 'title', 'inventory_management', 'inventory_limit', 'track', 'product_title'];

    public function product()
    {
        return $this->belongsTo('App\Domain\Products\Product');
    }

    public function setTitleAttribute($value)
    {
        if ($value === "Default Title") $this->attributes['title'] = 'N/A';
        else $this->attributes['title'] = $value;
    }

}