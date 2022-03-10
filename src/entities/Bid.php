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
	 * @return Bid[]
	 */
	public static function getAll(): array  {
		return [];
	}
	/**
	 * Uploads (Creates) a new bid and returns its ID.
	 *
	 * @param User $user
	 * @param UserItem[] $bid_items
	 *
	 * @return void
	 */
	public static function upload( User $user, array $bid_items ) {

	}


	/**
	 * Checks if the data for bid creation is correct.
	 *
	 * @param User $user
	 * @param UserItem[] $bid_items
	 *
	 * @return bool
	 */
	public static function isValidToCreate( User $user, array $bid_items ): bool {
		$user_items = $user->getItemsWithProductData();

		if ( ! $user_items ) {
			return false;
		}

		foreach ( $bid_items as $product_id => $bid_item_details ) {

		}

		foreach ( $user_items as $item ) {

		}
	}

}