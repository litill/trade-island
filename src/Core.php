<?php

namespace TradeIsland;

use TradeIsland\CPTS\CptBid;
use TradeIsland\Repos\ProductsRepo;
use TradeIsland\Rest\Profile;
use TradeIsland\Rest\TradeCenter;

/**
 * TradeIsland Core class responsible for bootstrapping the application.
 */
class Core {

	/**
	 * TradeIsland Core constructor.
	 */
	public function __construct() {
		$this->hookREST();
		$this->registerCPTS();
		$this->initRepos();
	}

	/**
	 * Hooks the classess responsible for REST communication.
	 *
	 * @return void
	 */
	public function hookREST() {
		add_action( 'rest_api_init', function() {
			( new TradeCenter() );
			( new Profile() );
		} );
	}

	/**
	 * Registers the Trade Island Custom Post Types.
	 *
	 * @return void
	 */
	private function registerCPTS() {
		new CptBid();
	}

	/**
	 * Initializes the repositories.
	 *
	 * @return void
	 */
	private function initRepos(): void {
		ProductsRepo::getInstance();
	}

}