<?php namespace App\Http\Controllers;


use App\Domain\Shops\Shop;
use App\Domain\Shops\ShopRepositoryInterface;
Use App\Infrastructure\Shopify\ShopifyProductConnector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use phpish\shopify;

class shopifyController extends Controller {

	private $shopifyProductConnector;
	private $shops;

	function __construct(ShopifyProductConnector $shopifyProductConnector, ShopRepositoryInterface $shops)
	{
		$this->shopifyProductConnector = $shopifyProductConnector;
		$this->shops = $shops;
	}


	public function shop()
	{
		$apiKey = Config::get('RNotifier.apiKey');
		$password = Config::get('RNotifier.password');
		$shopName = Config::get('RNotifier.shopName');

		$shopify = shopify\client($shopName, $apiKey, $password, true);
		try
		{
			# Making an API request can throw an exception
			$shop = $shopify('GET /admin/shop.json');
			print_r($shop);
		}
		catch (shopify\ApiException $e)
		{
			# HTTP status code was >= 400 or response contained the key 'errors'
			echo $e;
			print_R($e->getRequest());
			print_R($e->getResponse());
		}
		catch (shopify\CurlException $e)
		{
			# cURL error
			echo $e;
			print_R($e->getRequest());
			print_R($e->getResponse());
		}
	}

	public function product()
	{
		dd($this->shopifyProductConnector->retrieve());
	}

	public function toInstall()
	{


		# Guard
		isset($_GET['shop']) or die ('Query parameter "shop" missing.');
		preg_match('/^[a-zA-Z0-9\-]+.myshopify.com$/', $_GET['shop']) or die('Invalid myshopify.com store URL.');
		$install_url = shopify\install_url($_GET['shop'], Config::get('RNotifier.apiKey'));
		echo "<script> top.location.href='$install_url'</script>";
	}

	public function oauth()
	{

		# Guard: http://docs.shopify.com/api/authentication/oauth#verification
		shopify\is_valid_request($_GET, Config::get('RNotifier.sharedSecret')) or die('Invalid Request! Request or redirect did not come from Shopify');

		# Step 2: http://docs.shopify.com/api/authentication/oauth#asking-for-permission
		if (!isset($_GET['code']))
		{
			$permission_url = shopify\authorization_url($_GET['shop'], Config::get('RNotifier.apiKey'), array('read_content', 'write_content', 'read_themes', 'write_themes', 'read_products', 'write_products', 'read_customers', 'write_customers', 'read_orders', 'write_orders', 'read_script_tags', 'write_script_tags', 'read_fulfillments', 'write_fulfillments', 'read_shipping', 'write_shipping'));
			die("<script> top.location.href='$permission_url'</script>");
		}
		# Step 3: http://docs.shopify.com/api/authentication/oauth#confirming-installation
		try
		{
			# shopify\access_token can throw an exception
			$oauth_token = shopify\access_token($_GET['shop'], Config::get('RNotifier.apiKey'), Config::get('RNotifier.sharedSecret'), $_GET['code']);

			// if first time store shop in DB.
			$shop = $this->shops->firstOrCreate([
				'url' => $_GET['shop'],
				'remember_token' => $oauth_token
			]);

			// authenticate shop
			Auth::login($shop);

			// redirect to home
			return redirect(route('showInventoryRules'));

		}
		catch (shopify\ApiException $e)
		{
			# HTTP status code was >= 400 or response contained the key 'errors'
			echo $e;
			print_R($e->getRequest());
			print_R($e->getResponse());
		}
		catch (shopify\CurlException $e)
		{
			# cURL error
			echo $e;
			print_R($e->getRequest());
			print_R($e->getResponse());
		}



	}

}
