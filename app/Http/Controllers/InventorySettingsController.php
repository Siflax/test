<?php namespace App\Http\Controllers;


use App\Http\Requests\SearchProductsRequest;
use App\Domain\InventoryChecker\InventoryCheckerService;
use App\Domain\InventorySettings\SettingsRepositoryInterface;
use App\Domain\Products\ProductRepositoryInterface;
use App\Domain\Products\ProductSearcher;
use App\Domain\Products\Variants\VariantRepositoryInterface;
use App\Domain\Shops\Shop;
use App\Infrastructure\Factories\ProductFactory;
Use App\Infrastructure\Shopify\ShopifyProductConnector;
use App\Infrastructure\Factories\VariantFactory;
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

        $section = Request::get('section');

        if( ! $section ) $section = 'global';

        $data = [
          'section' => $section
        ];

        if ($section === 'global') $data += ['setting' => $this->settingsRepository->retrieveByShop($shop) ];

        if ($section === 'products') $data += ['products' => $this->productRepository->retrievePaginatedByShop($shop, true) ];

        if ($section === 'variants') {

            $data += ['variants' =>  $this->variantRepository->retrievePaginatedByShop($shop, true)];

            $productTitles = [];

            foreach($data['variants'] as $variant) {
                $productTitle = $variant->product_title;
                if (! in_array($productTitle, $productTitles)) array_push($productTitles, $productTitle);
            }

            $data += ['productTitles' => $productTitles];
        }



        if (Request::get('productTitle') )
        {
            if ($section == 'variants') $matches = $this->productSearcher->execute(Request::get('productTitle'), $shop, true);
            else $matches = $this->productSearcher->execute(Request::get('productTitle'), $shop);

            $data += ['matches' => $matches];
        }

  

        return view('settings.input', $data);
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
        $shop = Shop::find(1);

        $this->inventoryChecker->check($shop);
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