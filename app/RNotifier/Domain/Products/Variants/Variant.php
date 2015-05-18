<?php namespace App\RNotifier\Domain\Products\Variants;


use Illuminate\Database\Eloquent\Model;


class Variant extends Model
{

    protected $fillable = ['id', 'product_id', 'inventory_quantity', 'title', 'inventory_management', 'inventory_limit', 'track'];

    public function product()
    {
        $this->belongsTo('App\RNotifier\Domain\Products\Product');
    }

    public function setTitleAttribute($value)
    {
        if ($value === "Default Title") $this->attributes['title'] = 'N/A';
        else $this->attributes['title'] = $value;
    }

}