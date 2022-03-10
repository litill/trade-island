<?php

namespace TradeIsland;

use TradeIsland\CPTS\CptBid;
use TradeIsland\Entities\User;
use TradeIsland\Repos\ProductsRepo;

class Core {

	/**
	 * TradeIsland Core constructor.
	 */
	public function __construct() {
		$this->registerCPTS();
		$this->initRepos();
		$this->debug();
	}

	public function hookREST() {

	}

	private function registerCPTS() {
		new CptBid();
	}

	public function debug(): void {
		add_action( 'wp_footer', function() {
			try {
				$user = new User( 3 );
			} catch ( \Exception $e ) {
				return;
			}
//			$user->clearItems();
//			$user->generateRandomItems();
//			var_dump( $user->getItems() );
		});
	}

	private function initRepos(): void {
		ProductsRepo::getInstance();
	}
}