<?php namespace App\Http\Controllers;

use App\Domain\SubscriptionPlans\SubscriptionPlanRepository;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;


class SubscriptionPlansController extends Controller {

	private $subscriptionPlans;

	function __construct(SubscriptionPlanRepository $subscriptionPlans)
	{
		$this->subscriptionPlans = $subscriptionPlans;
	}


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$data = [
			'shopIsSubscribed' => $this->subscriptionPlans->shopIsSubscribed()
		];

		return view('account.subscriptionPlans.index')->with($data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$subscriptionPlan = $this->subscriptionPlans->createForShop();

		return redirect($subscriptionPlan->confirmation_url);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	public function activate()
	{
		$this->subscriptionPlans->activateForShop(Request::get('charge_id'));

		return redirect(route('subscription-plans.index'));
	}

}
