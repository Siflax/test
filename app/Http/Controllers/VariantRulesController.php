<?php namespace App\Http\Controllers;

use App\Domain\Products\ProductRepositoryInterface;
use App\Domain\Products\Variants\VariantRepositoryInterface;
use App\Domain\Shops\Shop;
use App\Http\Requests;
use App\Http\Controllers\Controller;


use Illuminate\Support\Facades\Request;

class VariantRulesController extends Controller {


	private $variants;
	private $products;

	function __construct(VariantRepositoryInterface $variants, ProductRepositoryInterface $products)
	{
		$this->variants = $variants;
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

		$variants = $this->variants->retrievePaginatedByShop($shop, true);

		return view('rules.variants.index', ['variants' => $variants]);
	}

	public function store()
	{
		$shop = Shop::find(1);

		$input  = Request::only('inventory_limit','track');
		$input['track'] = (bool) $input['track'];

		$this->variants->updateOrCreateByShop($shop, Request::only('id', 'product_id'), $input);
		
		return redirect()->back();
	}


}
