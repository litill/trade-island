<?php

namespace TradeIsland\Rest;

use WP_REST_Request;
use WP_REST_Response;

/**
 * Class TradeCenter
 * Handles the REST Endpoints related to Trade Center.
 */
class TradeCenter extends Base {

	public function __construct() {
		$this->registerRoutes();
	}

	/**
	 * Registers Trade Center REST routes.
	 *
	 * @return void
	 */
	public function registerRoutes(): void {
		$this->registerListBidsRoute();
		$this->registerUploadBidRoute();
		$this->registerAcceptBidRoute();
	}

	/**
	 * Registers the `List Bids` route (Get All Available)
	 * Method: [GET]
	 *
	 * @return void
	 */
	public function registerListBidsRoute(): void {
		register_rest_route( $this->namespace, '/trade-center', [
			[
				'methods'  => 'GET',
				'callback' => [ $this, 'handleListBids' ],
				'permission_callback' => static fn() => true,

			],
			'schema' => [ $this, 'getListBidsSchema' ],
		] );
	}

	/**
	 * Registers the `Upload` (Create) Bid route
	 * Method: [POST]
	 *
	 * @return void
	 */
	public function registerUploadBidRoute(): void {
		register_rest_route( $this->namespace, '/trade-center', [
			[
				'methods'  => 'POST',
				'callback' => [ $this, 'handleUploadBid' ],
				'permission_callback' => static fn() => true
			],
			'schema' => [ $this, 'getUploadBidSchema' ],
		] );
	}

	/**
	 * Registers the `Accept` (Trade) Bid route
	 * Method: [POST]
	 *
	 * @return void
	 */
	public function registerAcceptBidRoute(): void {
		register_rest_route( $this->namespace, '/trade-center/(?P<id>\d+)', [
			[
				'methods'  => 'POST',
				'callback' => [ $this, 'handleAcceptBid' ],
				'permission_callback' => static fn() => true
			],
			'schema' => [ $this, 'getAcceptBidSchema' ],
		] );
	}

	public function handleListBids( WP_REST_Request $request ): WP_Rest_Response {
		return new WP_Rest_Response( [
			'success' => true,
			'msg' => 'LIST BIDS'
		] );
	}

	public function handleUploadBid( WP_REST_Request $request ): WP_Rest_Response {
		return new WP_Rest_Response( [
			'success' => true,
			'msg' => 'UPLOAD BID'
		] );
	}

	public function handleAcceptBid( WP_REST_Request $request ): WP_Rest_Response {
		return new WP_Rest_Response( [
			'success' => true,
			'msg' => 'ACCEPT BID'
		] );
	}

	/**
	 * @todo
	 *
	 * @return array
	 */
	public function getListBidsSchema(): array {
		return [];
	}

	/**
	 * @todo
	 *
	 * @return array
	 */
	public function getUploadBidsSchema(): array {
		return [];
	}

	/**
	 * @todo
	 *
	 * @return array
	 */
	public function getAcceptBidsSchema(): array {
		return [];
	}

}