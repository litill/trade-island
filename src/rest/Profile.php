<?php

namespace TradeIsland\Rest;

use WP_REST_Request;
use WP_REST_Response;

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

	/**
	 * Profile REST handler constructor.
	 */
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
		register_rest_route( $this->namespace, '/profile/generate-items', [
			[
				'methods'  => 'POST',
				'callback' => [ $this, 'handleGenerateItems' ],
				'permission_callback' => static fn() => true
			],
			'schema' => [ $this, 'getGenerateItemsSchema' ],
		] );
	}

	/**
	 * @todo
	 * Registers the `My Items` route (list all user's items)
	 *
	 * @return void
	 */
	public function registerMyItemsRoute(): void {
		register_rest_route( $this->namespace, '/profile/items', [
			[
				'methods'  => 'GET',
				'callback' => [ $this, 'handleMyItems' ],
				'permission_callback' => static fn() => true
			],
			'schema' => [ $this, 'getMyItemsSchema' ],
		] );
	}

	/**
	 * @todo
	 * @param WP_REST_Request $request
	 *
	 * @return WP_REST_Response
	 */
	public function handleMyItems( WP_REST_Request $request ): WP_REST_Response {
		return new WP_REST_Response( [] );
	}

	/**
	 * @todo
	 * @param WP_REST_Request $request
	 *
	 * @return WP_REST_Response
	 */
	public function handleGenerateItems( WP_REST_Request $request ): WP_REST_Response {
		return new WP_REST_Response( [] );
	}

	public function getMyItemsSchema(): array {
		return [];
	}

	public function getGenerateItemsSchema(): array {
		return [];
	}
}