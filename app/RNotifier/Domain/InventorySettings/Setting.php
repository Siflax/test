<?php namespace App\RNotifier\Domain\InventorySettings;


use Illuminate\Database\Eloquent\Model;

class Setting extends Model  {

    protected $table = 'inventorySettings';

    protected $fillable = ['globalLimit'];

    public $timestamps = false;

    function __construct()
    {
    }

}