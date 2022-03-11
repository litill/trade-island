<?php

namespace TradeIsland\Rest;

use WP_REST_Request;
use WP_REST_Response;

/**
 * Class TradeCenter
 * Handles the REST Endpoints related to Trade Center.
 */
class TradeCenter extends Base {

	public function construct() {
		$this->registerRoutes();
	}

	protected function registerRoutes(): void {
		$this->registerListBidsRoute();
		$this->registerUploadBidRoute();
		$this->registerAcceptBidRoute();
	}

	protected function registerListBidsRoute(): void {
		register_rest_route( $this->namespace, '/trade-center', [
			[
				'methods'  => 'GET',
				'callback' => [ $this, 'handleListBids' ],
			],
			'schema' => [ $this, 'getListBidsSchema' ],
		] );
	}

	protected function registerUploadBidRoute(): void {
		register_rest_route( $this->namespace, '/trade-center', [
			[
				'methods'  => 'POST',
				'callback' => [ $this, 'handleUploadBid' ],
			],
			'schema' => [ $this, 'getUploadBidSchema' ],
		] );
	}

	protected function registerAcceptBidRoute(): void {
		register_rest_route( $this->namespace, '/trade-center/(?P<id>\d+)', [
			[
				'methods'  => 'POST',
				'callback' => [ $this, 'handleAcceptBid' ],
			],
			'schema' => [ $this, 'getAcceptBidSchema' ],
		] );
	}

	protected function handleListBids( WP_REST_Request $request ): WP_Rest_Response {
		return new WP_Rest_Response( [
			'success' => true,
			'msg' => 'LIST BIDS'
		] );
	}

	protected function handleUploadBid( WP_REST_Request $request ): WP_Rest_Response {
		return new WP_Rest_Response( [
			'success' => true,
			'msg' => 'UPLOAD BID'
		] );
	}

	protected function handleAcceptBid( WP_REST_Request $request ): WP_Rest_Response {
		return new WP_Rest_Response( [
			'success' => true,
			'msg' => 'ACCEPT BID'
		] );
	}

	protected function getListBidsSchema(): array {
		return [];
	}

	protected function getUploadBidsSchema(): array {
		return [];
	}

	protected function getAcceptBidsSchema(): array {
		return [];
	}

}