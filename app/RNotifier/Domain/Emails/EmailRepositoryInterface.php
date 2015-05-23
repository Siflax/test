<?php namespace App\RNotifier\Domain\Emails;


interface EmailRepositoryInterface {

    public function save( Email $email, $shopId);

}