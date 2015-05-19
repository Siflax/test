<?php namespace App\RNotifier\Domain\Emails;


use Illuminate\Database\Eloquent\Model;

class Email extends Model  {

    protected $fillable = ['address'];

    public function shop()
    {
        $this->belongsTo('App\RNotifier\Domain\Shops\Shop');
    }

}
