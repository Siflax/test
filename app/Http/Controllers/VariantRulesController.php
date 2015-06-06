<?php namespace App\Http\Controllers;

use App\Domain\Products\Variants\VariantRepositoryInterface;
use App\Domain\Shops\Shop;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class VariantRulesController extends Controller {


	private $variants;

	function __construct(VariantRepositoryInterface $variants)
	{
		$this->variants = $variants;
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


}
