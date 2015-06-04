<?php namespace App\Domain\Emails;


use Illuminate\Database\Eloquent\Model;

class Email extends Model  {

    protected $fillable = ['address'];

    public function shop()
    {
        $this->belongsTo('App\Domain\Shops\Shop');
    }

}
