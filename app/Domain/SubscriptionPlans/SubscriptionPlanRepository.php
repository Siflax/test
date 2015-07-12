<?php namespace App\Domain\SubscriptionPlans;


interface SubscriptionPlanRepository {

    public function getForShop();

    public function createForShop();

    public function activateForShop($id);

    public function shopIsSubscribed();

    public function getActiveSubscriptionPlan();
}