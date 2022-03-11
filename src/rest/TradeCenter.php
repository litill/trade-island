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

	public function registerRoutes(): void {
		$this->registerListBidsRoute();
		$this->registerUploadBidRoute();
		$this->registerAcceptBidRoute();
	}

	public function registerListBidsRoute(): void {
		register_rest_route( $this->namespace, '/trade-center', [
			[
				'methods'  => 'GET',
				'callback' => [ $this, 'handleListBids' ],
			],
			'schema' => [ $this, 'getListBidsSchema' ],
		] );
	}

	public function registerUploadBidRoute(): void {
		register_rest_route( $this->namespace, '/trade-center', [
			[
				'methods'  => 'POST',
				'callback' => [ $this, 'handleUploadBid' ],
			],
			'schema' => [ $this, 'getUploadBidSchema' ],
		] );
	}

	public function registerAcceptBidRoute(): void {
		register_rest_route( $this->namespace, '/trade-center/(?P<id>\d+)', [
			[
				'methods'  => 'POST',
				'callback' => [ $this, 'handleAcceptBid' ],
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

	public function getListBidsSchema(): array {
		return [];
	}

	public function getUploadBidsSchema(): array {
		return [];
	}

	public function getAcceptBidsSchema(): array {
		return [];
	}

}