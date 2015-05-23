<?php namespace App\Http\Controllers;


use App\Http\Requests\SearchProductsRequest;
use App\RNotifier\Domain\InventoryChecker\InventoryCheckerService;
use App\RNotifier\Domain\InventorySettings\Setting;
use App\RNotifier\Domain\InventorySettings\SettingsRepositoryInterface;
use App\RNotifier\Domain\Products\ProductRepositoryInterface;
use App\RNotifier\Domain\Products\ProductSearcher;
use App\RNotifier\Domain\Shops\Shop;
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
    private $productSearcher;

    function __construct(SettingsRepositoryInterface $settingsRepository, InventoryCheckerService $inventoryChecker, ShopifyProductConnector $shopifyProductConnector, ProductFactory $productFactory, ProductRepositoryInterface $productRepository, VariantFactory $variantFactory, ProductSearcher $productSearcher)
    {
        $this->settingsRepository = $settingsRepository;
        $this->inventoryChecker = $inventoryChecker;
        $this->productFactory = $productFactory;
        $this->variantFactory = $variantFactory;
        $this->shopifyProductConnector = $shopifyProductConnector;
        $this->productRepository = $productRepository;
        $this->productSearcher = $productSearcher;
    }

    public function show()
    {
        $shop = Shop::find(1);

        $setting = $this->settingsRepository->retrieveByShop($shop);

        $products = $this->productRepository->retrievePaginatedByShop($shop, true);

        return view('settings.input', ['setting' => $setting, 'products' => $products]);
    }

    public function store()
    {
        $shop = Shop::find(1);

        $globalLimit = Request::only('globalLimit');

        $this->settingsRepository->updateOrCreateByShop($shop, [], $globalLimit);

        return redirect()->back();
    }

    public function check()
    {
        $this->inventoryChecker->check();
    }

    public function search(SearchProductsRequest $request)
    {
        $shop = Shop::find(1);

        $products = $this->productRepository->retrievePaginatedByShop($shop, true);

        $matches = $this->productSearcher->execute(Request::get('productTitle'));

        $setting = $this->settingsRepository->retrieveByShop($shop);

        return view('settings.input', ['setting' => $setting, 'matches' => $matches, 'products' => $products]);
    }

    public function saveProductLimit()
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
                $track = Request::get('track');
                if (! $track) $track = 0;

                $variant = $this->variantFactory->create([
                    'id' => Request::get('variantId'),
                    'product_id' => Request::get('productId'),
                    'inventory_limit' => Request::get('individualLimit'),
                    'track' => $track
                ]);

                $variant->save();
            }

        }

        //$this->productRepository->save($product);

        return redirect()->back();

    }

    public function deleteRule($id)
    {
        //TODO: make sure that can only delete own products!!!

        // find variant

        // get product id

        // delete variant by id

        // if product has no children delete
    }

}