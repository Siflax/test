<?php namespace App\RNotifier\Domain\Webhooks;



use Illuminate\Database\Eloquent\Model;

class Webhook extends Model  {


    protected $fillable = ['url'];


}