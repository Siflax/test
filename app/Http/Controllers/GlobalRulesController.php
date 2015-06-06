<?php namespace App\Http\Controllers;

use App\Domain\InventorySettings\SettingsRepositoryInterface;
use App\Domain\Shops\Shop;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class GlobalRulesController extends Controller {

	/**
	 * @var SettingsRepositoryInterface
	 */
	private $settings;

	function __construct(SettingsRepositoryInterface $settings)
	{

		$this->settings = $settings;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$shop = Shop::find(1);

		$setting = $this->settings->retrieveByShop($shop);

		return view('rules.global.index', ['setting' => $setting]);
	}

}
