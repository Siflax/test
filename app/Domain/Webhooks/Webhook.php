<?php namespace App\Domain\Webhooks;



use Illuminate\Database\Eloquent\Model;

class Webhook extends Model  {


    protected $fillable = ['url'];


}