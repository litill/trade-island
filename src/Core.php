<?php

namespace TradeIsland;

use TradeIsland\CPTS\CptBid;
use TradeIsland\Entities\Bid;
use TradeIsland\Entities\User;
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
		$this->registerCPTS();
		$this->initRepos();
		$this->debug();
	}

	/**
	 * Hooks the classess responsible for REST communication.
	 *
	 * @return void
	 */
	public function hookREST() {
		add_action( 'rest_api_init', function() {
			new TradeCenter();
			new Profile();
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

	/**
	 * @todo remove this
	 * @return void
	 */
	public function debug(): void {
		add_action( 'wp_footer', function() {
			try {
				$user = new User( 3 );
			} catch ( \Exception $e ) {
				return;
			}
//			$user->clearItems();
//			$user->generateRandomItems();
//			echo '<pre>';
//			var_dump( $user->getItemsWithProductData() );
//			Bid::isValidToCreate( 3, [] );
//			echo '</pre>';
		});
	}

}