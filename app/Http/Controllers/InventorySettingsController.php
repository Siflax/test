<?php namespace App\Http\Controllers;


use App\RNotifier\Domain\InventorySettings\Setting;
use App\RNotifier\Domain\InventorySettings\SettingsRepositoryInterface;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\View;

class InventorySettingsController extends Controller {

    /**
     * @var SettingsRepositoryInterface
     */
    private $settingsRepository;

    function __construct(SettingsRepositoryInterface $settingsRepository)
    {
        $this->settingsRepository = $settingsRepository;
    }

    public function show()
    {
        $id = 1;
        $setting = $this->settingsRepository->retrieveById($id);

        return view('settings.input', ['setting' => $setting]);

    }

    public function store()
    {
        $globalLimit = Request::only('globalLimit');

        if (Request::has('id'))
        {
            $setting = $this->settingsRepository->retrieveById(Request::input('id'));

            $setting->fill($globalLimit);

            $this->settingsRepository->save($setting);
        }
        else
        {
            $setting = new Setting();

            $setting->fill($globalLimit);

            $this->settingsRepository->create($setting);
        }

        return redirect()->back();
    }

}