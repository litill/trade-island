<?php

namespace TradeIsland\Entities;

use Exception;
use WP_Post;

class Bid {

	public static string $META_BID_ITEMS = 'ti_bid_items';

	private WP_Post $_wp_bid;

	public function __construct( int $bid_ID ) {
		if ( ! $bid_ID ) {
			throw new Exception( 'Wrong bid ID' );
		}

		$post = get_post( $bid_ID, OBJECT );

		if ( ! $post ) {
			throw new Exception( 'Bid does not exists' );
		}

		$this->_wp_bid = $post;
	}

	/**
	 * Creates a new bid and returns its ID.
	 *
	 * @param User $user
	 * @param array $items
	 *
	 * @return void
	 */
	public static function create( User $user, array $items ) {

	}

	/**
	 * Checks if the data for bid creation is correct.
	 *
	 * @return bool
	 */
	public static function isValidToCreate( int $user_id, array $items ): bool {
		try {
			$user = new User( $user_id );
		} catch ( Exception $e ) {
			return false;
		}

		$user_items = $user->getItems();
	}

}