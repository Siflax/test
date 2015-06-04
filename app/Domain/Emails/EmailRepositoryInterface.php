<?php namespace App\Domain\Emails;


interface EmailRepositoryInterface {

    public function save( Email $email, $shopId);

}