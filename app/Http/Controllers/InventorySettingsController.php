<?php namespace App\Http\Controllers;


use App\RNotifier\Domain\InventoryChecker\InventoryCheckerService;
use App\RNotifier\Domain\InventorySettings\Setting;
use App\RNotifier\Domain\InventorySettings\SettingsRepositoryInterface;
use App\RNotifier\Domain\Products\ProductRepositoryInterface;
use App\RNotifier\Infrastructure\Products\EloquentProductRepository;
use App\RNotifier\Infrastructure\Products\ProductFactory;
use App\RNotifier\Infrastructure\Products\Variants\VariantFactory;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\View;

class InventorySettingsController extends Controller
{

    private $settingsRepository;
    private $inventoryChecker;
    private $productRepository;
    private $productFactory;
    /**
     * @var EloquentProductRepository
     */
    private $eloquentProductRepository;
    /**
     * @var VariantFactory
     */
    private $variantFactory;

    function __construct(SettingsRepositoryInterface $settingsRepository, InventoryCheckerService $inventoryChecker, ProductRepositoryInterface $productRepository, ProductFactory $productFactory, EloquentProductRepository $eloquentProductRepository, VariantFactory $variantFactory)
    {
        $this->settingsRepository = $settingsRepository;
        $this->inventoryChecker = $inventoryChecker;
        $this->productRepository = $productRepository;
        $this->productFactory = $productFactory;
        $this->eloquentProductRepository = $eloquentProductRepository;
        $this->variantFactory = $variantFactory;
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

        if (Request::has('id')) {
            $setting = $this->settingsRepository->retrieveById(Request::input('id'));

            $setting->fill($globalLimit);

            $this->settingsRepository->save($setting);
        } else {
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

        foreach ($products as $product) {
            if ($product->titleContains(Request::get('productTitle'))) $matches[] = $product;
        }

        $idsList = '';
        foreach ($matches as $match) {
            if (!$idsList) $idsList = $match->id;
            else $idsList .= ', ' . $match->id;
        }

        $products = $this->productRepository->retrieve(['ids' => $idsList]);

        $id = 1;
        $setting = $this->settingsRepository->retrieveById($id);

        return view('settings.input', ['setting' => $setting, 'matches' => $products]);

    }

    public function individualLimit()
    {
        $product = $this->eloquentProductRepository->retrieveById(Request::get('productId'));

        if (! $product)
        {
            $product = $this->productFactory->create(['id' => Request::get('productId')]);

            $this->eloquentProductRepository->save($product);

            $variant = $this->variantFactory->create(['id' => Request::get('variantId'), 'product_id' => Request::get('productId'), 'inventory_limit' => Request::get('individualLimit')]);

            $variant->save();
        }


        //$this->eloquentProductRepository->save($product);



        //'product_id', 'inventory_quantity', 'title', 'inventory_management'];
    }

}