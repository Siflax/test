<?php namespace App\Http\Controllers;


use App\RNotifier\Domain\Emails\Email;
use App\RNotifier\Domain\Emails\EmailRepositoryInterface;
use App\RNotifier\Domain\Webhooks\Webhook;
use App\RNotifier\Domain\Webhooks\WebhookRepositoryInterface;
use Illuminate\Support\Facades\Request;


class NotificationsController extends Controller {

    private $emailRepository;
    private $webhookRepository;

    function __construct(EmailRepositoryInterface $emailRepository, WebhookRepositoryInterface $webhookRepository)
    {
        $this->emailRepository = $emailRepository;
        $this->webhookRepository = $webhookRepository;
    }


    public function show()
    {

        $emails = $this->emailRepository->retrieveAll();
        $webhooks = $this->webhookRepository->retrieveAll();
        return view('notifications.input', ['emails' => $emails, 'webhooks' => $webhooks]);
    }

    public function addEmail()
    {

        $email = new Email([
            'address' => Request::get('emailAddress')
        ]);

        $this->emailRepository->save($email);

        return redirect()->back();
    }

    public function removeEmail($id)
    {   //TODO: when multi tenant- should only be able to delete own
        $this->emailRepository->delete($id);
        return redirect()->back();
    }

    public function removeWebhook($id)
    {//TODO: when multi tenant- should only be able to delete own
        $this->webhookRepository->delete($id);
        return redirect()->back();
    }

    public function addWebhook()
    {
        $webhook = new Webhook([
           'url' => Request::get('url')
        ]);

        $this->webhookRepository->save($webhook);

        return redirect()->back();
    }

}