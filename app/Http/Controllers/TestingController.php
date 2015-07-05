<?php namespace App\Http\Controllers;

use App\Domain\InventoryChecker\InventoryCheckerService;
use App\Domain\Shops\Shop;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestingController extends Controller {

	private $checker;

	function __construct(InventoryCheckerService $checker)
	{
		$this->checker = $checker;
	}


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function test()
	{
		$shop = Auth::user();

		$this->checker->check($shop);
	}

}
