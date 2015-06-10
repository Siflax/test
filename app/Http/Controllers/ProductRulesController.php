<?php namespace App\Http\Controllers;

use App\Domain\Products\ProductRepositoryInterface;
use App\Domain\Products\ProductSearcher;
use App\Domain\Shops\Shop;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;

use App\Http\Requests\SearchProductsRequest;


class ProductRulesController extends Controller {

	private $products;
	private $productSearcher;

	function __construct(ProductRepositoryInterface $products, ProductSearcher $productSearcher)
	{
		$this->products = $products;
		$this->productSearcher = $productSearcher;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$shop = Shop::find(1);

		$products = $this->products->retrievePaginatedByShop($shop, true);

		return view('rules.products.index', ['products' => $products]);
	}

	public function search(SearchProductsRequest $request)
	{
		$shop = Shop::find(1);

		$matches = $this->productSearcher->execute(Request::get('productTitle'), $shop);
		
		return view('partials.matches', ['matches' => $matches]);
	}

}
