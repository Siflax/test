<?php namespace App\Domain\SubscriptionPlans;


use Illuminate\Database\Eloquent\Model;

class SubscriptionPlan extends Model{

    protected $fillable = [
        "activated_on",
        "api_client_id",
        "billing_on",
        "cancelled_on",
        "created_at",
        "id",
        "name",
        "price",
        "return_url",
        "status",
        "test",
        "trial_days",
        "trial_ends_on",
        "updated_at",
        "decorated_return_url",
        "confirmation_url"
    ];

    // Turn off carbon date mutations
    public function getDates()
    {
        return array();
    }

    public function isActive()
    {
        if ($this->status === 'active') return true;
        else return false;
    }

}