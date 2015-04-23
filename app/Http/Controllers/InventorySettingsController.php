<?php namespace App\Http\Controllers;


use App\RNotifier\Domain\InventoryChecker\InventoryCheckerService;
use App\RNotifier\Domain\InventorySettings\Setting;
use App\RNotifier\Domain\InventorySettings\SettingsRepositoryInterface;
use App\RNotifier\Domain\Products\ProductRepositoryInterface;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\View;

class InventorySettingsController extends Controller {

    /**
     * @var SettingsRepositoryInterface
     */
    private $settingsRepository;
    /**
     * @var InventoryCheckerService
     */
    private $inventoryChecker;
    /**
     * @var ProductRepositoryInterface
     */
    private $productRepository;

    function __construct(SettingsRepositoryInterface $settingsRepository, InventoryCheckerService $inventoryChecker, ProductRepositoryInterface $productRepository)
    {
        $this->settingsRepository = $settingsRepository;
        $this->inventoryChecker = $inventoryChecker;
        $this->productRepository = $productRepository;
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

    public function check()
    {
        $this->inventoryChecker->check();
    }

    public function search()
    {

        $products = $this->productRepository->retrieve([
            'fields' => 'title, id'
        ]);

        $matches = [];

        foreach ($products as $product)
        {
            if($product->titleContains(Request::get('productTitle'))) $matches[] = $product;
        }

        dd($matches);

    }

}