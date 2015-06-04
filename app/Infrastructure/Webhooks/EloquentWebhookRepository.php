<?php namespace App\Infrastructure\Webhooks;


use App\Domain\Webhooks\Webhook;
use App\Domain\Webhooks\WebhookRepositoryInterface;

class EloquentWebhookRepository implements WebhookRepositoryInterface {

    public function save($webhook)
    {
        $webhook->save();
    }

    public function retrieveAll()
    {
        $emails = Webhook::all();

        return $emails;
    }

    public function delete($id)
    {
        Webhook::destroy($id);
    }

}