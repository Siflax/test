<?php namespace App\Http\Controllers;

use App\Domain\Products\ProductRepositoryInterface;
use App\Domain\Products\ProductSearcher;
use App\Domain\Products\Variants\VariantRepositoryInterface;
use App\Domain\Shops\Shop;
use App\Http\Requests;
use App\Http\Controllers\Controller;


use App\Http\Requests\SearchProductsRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class VariantRulesController extends Controller {


	private $variants;
	private $products;
	private $productSearcher;

	function __construct(VariantRepositoryInterface $variants, ProductRepositoryInterface $products, ProductSearcher $productSearcher)
	{
		$this->variants = $variants;
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
		$shop = Auth::user();

		$variants = $this->variants->retrievePaginatedByShop($shop, true);

		return view('rules.variants.index', ['variants' => $variants]);
	}

	public function store()
	{
		$shop = Auth::user();

		$input  = Request::only('inventory_limit','track');
		$input['track'] = (bool) $input['track'];

		$this->variants->updateOrCreateByShop($shop, Request::only('id', 'product_id'), $input);
		
		return redirect()->back();
	}

	public function search(SearchProductsRequest $request)
	{
		$shop = Auth::user();

		$matches = $this->productSearcher->execute(Request::get('productTitle'), $shop);

		return view('rules.variants.partials.matches', ['matches' => $matches]);
	}

}
