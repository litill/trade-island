<?php

namespace TradeIsland\Entities;

use Exception;
use TradeIsland\CPTS\CptBid;
use WP_Post;
use WP_Query;

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
	 * Returns all Bids available in Trade Island.
	 *
	 * @return Bid[]
	 * @throws Exception
	 */
	public static function getAll(): array  {
		$bids_query = new WP_Query([
			'post_type' => CptBid::CPT_SLUG,
			'post_status' => 'publish',
			'fields' => 'ids',
		]);

		if ( ! $bids_query->have_posts() ) {
			return [];
		}

		return array_map( fn ( int $bid_ID) => new Bid( $bid_ID ), $bids_query->posts );
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

		if ( ! $user->areItemsInInventory( $bid_items ) ) {
			return false;
		}

		return true;
	}

}