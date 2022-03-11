<?php

namespace TradeIsland\Entities;

use Exception;
use TradeIsland\CPTS\CptBid;
use WP_Post;
use WP_Query;

class Bid {

	public const META_BID_ITEMS = 'ti_bid_items';
	public const META_BID_BUYER = 'ti_bid_buyer_id';

	/**
	 * The base WP_Post object representing the bid.
	 *
	 * @var WP_Post
	 */
	private WP_Post $_wp_bid;

	/**
	 * ID of the buyer (non-0 if the bid is completed)
	 *
	 * @var int
	 */
	private int $_bid_buyer_id;

	/**
	 * Items in this bid.
	 *
	 * @var UserItem[]
	 */
	private array $_bid_items;

	/**
	 * @throws Exception
	 */
	public function __construct( int $bid_ID ) {
		$this->fetchBidPost( $bid_ID );
	}

	/**
	 * Sell the items in this bid to the specified buyer_id
	 *
	 * @param int $buyer_id
	 * @param UserItem[] $exchange_items
	 *
	 * @return bool
	 * @throws Exception
	 */
	public function trade( int $buyer_id, array $exchange_items ): bool {
		$this->transferItemsBetweenUsers( );
		$this->updateBuyer( $buyer_id );
		$this->setStatusCompleted();
		$this->fetchBidPost( $this->_wp_bid->ID );
		return true;
	}

	/**
	 * @todo
	 *
	 * @return void
	 */
	public function transferItemsBetweenUsers() {

	}

	/**
	 * @throws Exception
	 */
	private function fetchBidPost( int $bid_ID ): void {
		if ( ! $bid_ID ) {
			throw new Exception( 'Wrong bid ID' );
		}

		$post = get_post( $bid_ID, OBJECT );

		if ( ! $post ) {
			throw new Exception( 'Bid does not exists' );
		}

		$this->_wp_bid = $post;
		$this->fetchBuyerID();
		$this->fetchBidItems();
	}

	private function fetchBuyerID(): void {
		$this->_bid_buyer_id = get_post_meta( $this->_wp_bid->ID, static::META_BID_BUYER, true );
	}

	private function fetchBidItems(): void {
		$this->_bid_items = [];
	}

	/**
	 * Updates the bid's Buyer ID.
	 *
	 * @param int $buyer_id
	 *
	 * @return void
	 */
	public function updateBuyer( int $buyer_id ): void {
		update_post_meta( $this->_wp_bid->ID, static::META_BID_BUYER, $buyer_id );
	}

	/**
	 * Sets the status to completed on the bid.
	 */
	public function setStatusCompleted(): bool {
		$id = wp_update_post([
			'ID' => $this->_wp_bid->ID,
			'post_status' => CptBid::STATUS_SLUG_COMPLETE
		]);

		if ( ! $id ) {
			return false;
		}

		return true;
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

		return array_map( fn ( int $bid_ID ) => new Bid( $bid_ID ), $bids_query->posts );
	}

	/**
	 * Uploads (Creates) a new bid and returns its ID.
	 * @todo
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

	/**
	 * @todo
	 *
	 * @return bool
	 */
	public static function isValidTransaction(): bool {
		return true;
	}

}