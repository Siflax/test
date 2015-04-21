<?php namespace App\Http\Controllers;


use App\RNotifier\Domain\InventorySettings\Setting;
use App\RNotifier\Domain\InventorySettings\SettingsRepositoryInterface;
use Illuminate\Support\Facades\Input;
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
        return view('settings.input');

    }

    public function store()
    {
        $globalLimit = Input::only('globalLimit');

        $setting = New Setting();

        $setting->fill($globalLimit);

        $this->settingsRepository->create($setting);
    }

}