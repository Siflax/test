<?php namespace App\Http\Controllers;

use App\Domain\Products\ProductRepositoryInterface;
use App\Domain\Shops\Shop;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class ProductRulesController extends Controller {

	private $products;

	function __construct(ProductRepositoryInterface $products)
	{
		$this->products = $products;
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

}
