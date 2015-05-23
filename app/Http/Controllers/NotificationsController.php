<?php namespace App\Http\Controllers;


use App\RNotifier\Domain\Emails\Email;
use App\RNotifier\Domain\Emails\EmailRepositoryInterface;
use App\RNotifier\Domain\InventorySettings\SettingsRepositoryInterface;
use App\RNotifier\Domain\Shops\Shop;
use Illuminate\Support\Facades\Request;


class NotificationsController extends Controller {

    private $emailRepository;
    private $settingsRepository;

    function __construct(EmailRepositoryInterface $emailRepository, SettingsRepositoryInterface $settingsRepository)
    {
        $this->emailRepository = $emailRepository;
        $this->settingsRepository = $settingsRepository;
    }


    public function show()
    {
        $shop = Shop::find(1);

        $settings = $this->settingsRepository->retrieveByShop($shop);

        $emails = $this->emailRepository->retrievePaginatedForShop($shop);

        return view('notifications.input', ['emails' => $emails, 'settings' => $settings]);
    }

    public function addEmail()
    {
        $shopId = 1;

        $email = new Email([
            'address' => Request::get('emailAddress')
        ]);

        $this->emailRepository->save($email, $shopId);

        return redirect()->back();
    }

    public function removeEmail($id)
    {
        $shopId = 1;

        $this->emailRepository->delete($id, $shopId);
        return redirect()->back();
    }


    public function saveFrequency()
    {
        $shop = Shop::find(1);

        $setting = $this->settingsRepository->retrieveByShop($shop);

        $setting->frequency = Request::get('frequency');

        $setting->save();

        return redirect()->back();
    }

}