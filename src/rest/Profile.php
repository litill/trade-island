<?php

namespace TradeIsland\Rest;

/**
 * Class Profile
 * Handles the REST Endpoints related to User's Profile
 *
 * DISCLAIMER:
 *
 * =========================================================================================
 * For the purpose of demoing out the functionality, the routes here
 * expect that the client that calls them is authenticated (i.e. the wp_user_id is set).
 * During the development I used the "Insomnia" REST client with Basic Auth authentication
 * setup on the routes.
 *
 * The WordPress itself had the "Basic Auth" plugin installed:
 *
 * @see https://github.com/WP-API/Basic-Auth
 * =========================================================================================
 *
 */
class Profile extends Base {

	public function __construct() {
		$this->registerRoutes();
	}

	/**
	 * For this particular API region we could use the /wp-json/wp/v2/users routes and enrich them
	 * but for the scope of this project and clarity, I chose to demo the 'profile' as a part of the
	 * unified set of trade-island/ routes.
	 *
	 * @return void
	 */
	public function registerRoutes(): void {
		$this->registerGenerateItemsRoute();
		$this->registerMyItemsRoute();
	}

	/**
	 * @todo
	 * Registers the Initial (one-time) user items generation route.
	 *
	 * @return void
	 */
	public function registerGenerateItemsRoute(): void {

	}

	/**
	 * @todo
	 * Registers the `My Items` route (list all user's items)
	 *
	 * @return void
	 */
	public function registerMyItemsRoute(): void {

	}
}