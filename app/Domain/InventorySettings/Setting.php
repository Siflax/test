<?php namespace App\Domain\InventorySettings;


use Illuminate\Database\Eloquent\Model;

class Setting extends Model  {

    protected $table = 'inventorySettings';

    protected $fillable = ['globalLimit', 'frequency', 'isTrackedGlobally'];

    protected $casts = [
        'isTrackedGlobally' => 'boolean',
    ];

    public $timestamps = false;

    function __construct()
    {
    }

    public function shop()
    {
        $this->belongsTo('App\Domain\Shops\Shop');
    }

    public function frequencyIsWeekly()
    {
        if($this->frequency == 'Weekly') return true;
        else return false;
    }

    public function frequencyIsDaily()
    {
        if($this->frequency == 'Daily') return true;
        else return false;
    }

}