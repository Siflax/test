<?php namespace App\Http\Controllers;


use App\RNotifier\Domain\InventoryChecker\InventoryCheckerService;
use App\RNotifier\Domain\InventorySettings\Setting;
use App\RNotifier\Domain\InventorySettings\SettingsRepositoryInterface;
use App\RNotifier\Domain\Products\ProductRepositoryInterface;
use App\RNotifier\Domain\Products\Variants\VariantRepositoryInterface;
use App\RNotifier\Infrastructure\Products\ProductFactory;
use App\RNotifier\Infrastructure\Products\ShopifyProductConnector;
use App\RNotifier\Infrastructure\Products\Variants\VariantFactory;
use Illuminate\Support\Facades\Request;

class InventorySettingsController extends Controller
{

    private $settingsRepository;
    private $inventoryChecker;
    private $productFactory;
    private $variantFactory;
    private $shopifyProductConnector;
    private $productRepository;
    private $variantRepository;

    function __construct(SettingsRepositoryInterface $settingsRepository, InventoryCheckerService $inventoryChecker, ShopifyProductConnector $shopifyProductConnector, ProductFactory $productFactory, ProductRepositoryInterface $productRepository, VariantFactory $variantFactory, VariantRepositoryInterface $variantRepository)
    {
        $this->settingsRepository = $settingsRepository;
        $this->inventoryChecker = $inventoryChecker;
        $this->productFactory = $productFactory;
        $this->variantFactory = $variantFactory;
        $this->shopifyProductConnector = $shopifyProductConnector;
        $this->productRepository = $productRepository;
        $this->variantRepositoryInterface = $variantRepository;
    }

    public function show()
    {
        $id = 1;
        $setting = $this->settingsRepository->retrieveById($id);

        $products = $this->productRepository->retrieveAll();

        $prods = [];

        foreach ($products as $product)
        {
            $prods[] = $this->shopifyProductConnector->getDetails($product);
        }

        return view('settings.input', ['setting' => $setting, 'products' => $prods]);

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

        $products = $this->productRepository->retrieveAll();

        $prods = [];

        foreach ($products as $product)
        {
            $prods[] = $this->shopifyProductConnector->getDetails($product);
        }

        $products = $this->shopifyProductConnector->retrieve([
            'fields' => 'title, id'
        ]);

        $matches = [];

        foreach ($products as $product) {
            if ($product->titleContains(Request::get('productTitle'))) $matches[] = $product;
        }

        $products = [];

        foreach ($matches as $match) {
            $product = $this->productRepository->retrieveById($match->id);

            if (! $product) $product = $match;

            $product = $this->shopifyProductConnector->getDetails($product);

            $products[] = $product;
        }

        $id = 1;
        $setting = $this->settingsRepository->retrieveById($id);

        return view('settings.input', ['setting' => $setting, 'matches' => $products, 'products' => $prods]);

    }

    public function individualLimit()
    {
        $product = $this->productRepository->retrieveById(Request::get('productId'));

        if (! $product)
        {
            $product = $this->productFactory->create(['id' => Request::get('productId')]);

            $this->productRepository->save($product);

            $variant = $this->variantFactory->create([
                'id' => Request::get('variantId'),
                'product_id' => Request::get('productId'),
                'inventory_limit' => Request::get('individualLimit'),
                'track' => Request::get('track')
            ]);

            $variant->save();
        }
        else
        {

            $variant = $product->variants->where('product_id', $product->id)->where('id', (int) Request::get('variantId'))->first();

            if ($variant)
            {
                $variant->inventory_limit = Request::get('individualLimit');
                $variant->track = Request::get('track');
                $variant->save();
            }
            else
            {
                $variant = $this->variantFactory->create([
                    'id' => Request::get('variantId'),
                    'product_id' => Request::get('productId'),
                    'inventory_limit' => Request::get('individualLimit'),
                    'track' => Request::get('track')
                ]);

                $variant->save();
            }

        }

        //$this->productRepository->save($product);

        return redirect()->to('settings/inventory');

    }

}