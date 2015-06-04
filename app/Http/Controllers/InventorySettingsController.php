<?php namespace App\Http\Controllers;


use App\Http\Requests\SearchProductsRequest;
use App\RNotifier\Domain\InventoryChecker\InventoryCheckerService;
use App\RNotifier\Domain\InventorySettings\SettingsRepositoryInterface;
use App\RNotifier\Domain\Products\ProductRepositoryInterface;
use App\RNotifier\Domain\Products\ProductSearcher;
use App\RNotifier\Domain\Products\Variants\VariantRepositoryInterface;
use App\RNotifier\Domain\Shops\Shop;
use App\Infrastructure\Products\ProductFactory;
use App\Infrastructure\Products\ShopifyProductConnector;
use App\Infrastructure\Products\Variants\VariantFactory;
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
    private $variantRepository;

    function __construct(SettingsRepositoryInterface $settingsRepository, InventoryCheckerService $inventoryChecker, ShopifyProductConnector $shopifyProductConnector, ProductFactory $productFactory, ProductRepositoryInterface $productRepository, VariantFactory $variantFactory, ProductSearcher $productSearcher, VariantRepositoryInterface $variantRepository)
    {
        $this->settingsRepository = $settingsRepository;
        $this->inventoryChecker = $inventoryChecker;
        $this->productFactory = $productFactory;
        $this->variantFactory = $variantFactory;
        $this->shopifyProductConnector = $shopifyProductConnector;
        $this->productRepository = $productRepository;
        $this->productSearcher = $productSearcher;
        $this->variantRepository = $variantRepository;
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

        $globalLimit = Request::only('globalLimit', 'isTrackedGlobally');

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

        $matches = $this->productSearcher->execute(Request::get('productTitle'), $shop);

        $setting = $this->settingsRepository->retrieveByShop($shop);

        return view('settings.input', ['setting' => $setting, 'matches' => $matches, 'products' => $products]);
    }

    public function saveVariantRule()
    {
        $track = (bool) Request::get('track');

        $shop = Shop::find(1);

        $product = $this->productRepository->firstOrCreateByShop($shop, ['id' => Request::get('productId')]);

        $variant = $this->variantRepository->firstOrNewByProduct(
            $product,
            ['id' => Request::get('variantId')]
        );

        $variant->product_id = Request::get('productId');
        $variant->inventory_limit = Request::get('individualLimit');
        $variant->track = $track;

        $variant->save();

        return redirect()->back();
    }

    public function deleteVariantRule($id)
    {
        $shopId = 1;

        $this->variantRepository->delete($id, $shopId);

        return redirect()->back();
    }

    public function saveProductRule()
    {
        $track = (bool) Request::get('track');

        $shop = Shop::find(1);

        $product = $this->productRepository->firstOrCreateByShop($shop, ['id' => Request::get('productId')]);

        $product->inventory_limit = Request::get('individualLimit');
        $product->track = $track;
        $product->save();

        foreach(Request::get('variants') as $variantId => $values)
        {
            if ( ! isset($values['track'])) $values['track'] = false;

            $variant = $this->variantRepository->firstOrNewByProduct(
                $product,
                ['id' => $variantId]
            );

            $variant->product_id = Request::get('productId');
            $variant->inventory_limit = $values['individualLimit'];
            $variant->track = (bool) $values['track'];

            $variant->save();
        }

        return redirect()->back();
    }

    public function deleteProductRule()
    {

    }

}