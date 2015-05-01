<?php namespace App\RNotifier\Domain\Emails;


interface EmailRepositoryInterface {

    public function save($email);

}