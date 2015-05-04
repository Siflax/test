<?php namespace App\Http\Controllers;


use App\RNotifier\Domain\Emails\Email;
use App\RNotifier\Domain\Emails\EmailRepositoryInterface;
use App\RNotifier\Domain\InventorySettings\SettingsRepositoryInterface;
use App\RNotifier\Domain\Webhooks\Webhook;
use App\RNotifier\Domain\Webhooks\WebhookRepositoryInterface;
use Illuminate\Support\Facades\Request;


class NotificationsController extends Controller {

    private $emailRepository;
    private $webhookRepository;
    private $settingsRepository;

    function __construct(EmailRepositoryInterface $emailRepository, WebhookRepositoryInterface $webhookRepository, SettingsRepositoryInterface $settingsRepository)
    {
        $this->emailRepository = $emailRepository;
        $this->webhookRepository = $webhookRepository;
        $this->settingsRepository = $settingsRepository;
    }


    public function show()
    {
        //TODO: fix
        $id = 1;
        $settings = $this->settingsRepository->retrieveById($id);
        $emails = $this->emailRepository->retrieveAll();
        $webhooks = $this->webhookRepository->retrieveAll();
        return view('notifications.input', ['emails' => $emails, 'webhooks' => $webhooks, 'settings' => $settings]);
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

    public function saveFrequency()
    {
        //TODO: fix
        $id = 1;
        $setting = $this->settingsRepository->retrieveById($id);

        $setting->frequency = Request::get('frequency');

        $setting->save();

        return redirect()->back();
    }

}