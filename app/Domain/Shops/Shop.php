<?php namespace App\Domain\Shops;


use Illuminate\Database\Eloquent\Model;


use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class Shop extends Model implements AuthenticatableContract{

    use Authenticatable;

    protected $fillable = ['url', 'remember_token'];

    public function products()
    {
        return $this->hasMany('App\Domain\Products\Product');
    }

    public function emails()
    {
        return $this->hasMany('App\Domain\Emails\Email');
    }

    public function settings()
    {
        return $this->hasMany('App\Domain\InventorySettings\Setting');
    }

    public function variants()
    {
        return $this->hasMany('App\Domain\Products\Variants\Variant');
    }


    /**
     * Overwrites the function in the Authenticatable trait.
     * This prevents laravel from changing the remember
     * token when a user logs in or -out
     *
     * @param string $value
     */
    public function setRememberToken($value)
    {
        // not supported
    }

}