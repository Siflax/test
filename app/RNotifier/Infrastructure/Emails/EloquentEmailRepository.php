<?php namespace App\RNotifier\Infrastructure\Emails;


use App\RNotifier\Domain\Emails\Email;
use App\RNotifier\Domain\Emails\EmailRepositoryInterface;

class EloquentEmailRepository implements EmailRepositoryInterface{

    public function save($email)
    {
        $email->save();
    }

    public function retrieveAll()
    {
        $emails = Email::all();

        return $emails;
    }

    public function delete($id)
    {
        Email::destroy($id);
    }
}