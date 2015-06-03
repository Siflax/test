<?php namespace App\Commands;

use App\Commands\Command;

use App\RNotifier\Domain\InventoryChecker\InventoryCheckerService;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldBeQueued;

class NotifyShops extends Command implements SelfHandling, ShouldBeQueued {

	use InteractsWithQueue, SerializesModels;

	private $inventoryChecker;

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct(InventoryCheckerService $inventoryChecker)
	{
		$this->inventoryChecker = $inventoryChecker;
	}

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle()
	{
		$this->inventoryChecker->check();
	}

}
