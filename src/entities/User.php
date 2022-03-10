<?php

namespace TradeIsland\Entities;

use Exception;
use TradeIsland\Repos\ProductsRepo;
use WP_User;

class User {

	/**
	 * WP_User meta field name.
	 * @var string
	 */
	public static string $META_USER_ITEMS = 'ti_user_items';

	/**
	 * WP_User meta field name.
	 * @var string
	 */
	public static string $META_USER_ITEMS_GENERATED = 'ti_user_items_generated';

	/**
	 * Minimum initial total value for items.
	 * @var int
	 */
	public static int $MIN_INITIAL_ITEMS_VALUE = 3;

	/**
	 * Maximum initial total value for items.
	 * @var int
	 */
	public static int $MAX_INITIAL_ITEMS_VALUE = 20;

	/**
	 * WP_User object.
	 * @var WP_User
	 */
	private WP_User $_wp_user;

	/**
	 * User constructor.
	 *
	 * @throws Exception
	 */
	public function __construct( int $ID ) {
		$wp_user = get_user_by( 'ID', $ID );

		if ( ! $wp_user ) {
			throw new Exception( 'User not found!' );
		}

		$this->_wp_user = $wp_user;
	}

	/**
	 * Gets user items.
	 * @return array
	 */
	public function getItems(): array {
		$items = get_user_meta( $this->_wp_user->ID, static::$META_USER_ITEMS, true );

		if ( ! $items ) {
			return [];
		}

		return $items;
	}

	/**
	 * Deletes all user's items and set the generation flag to false.
	 *
	 * @return void
	 */
	public function clearItems(): void {
		update_user_meta( $this->_wp_user->ID, static::$META_USER_ITEMS, [] );
		update_user_meta( $this->_wp_user->ID, static::$META_USER_ITEMS_GENERATED, false );
	}

	/**
	 * Generates random initial user's inventory.
	 */
	public function generateRandomItems(): void {
		if ( $this->hasItemsGenerated() ) {
			return;
		}

		$random_max = rand( (int)( static::$MAX_INITIAL_ITEMS_VALUE / 3 ), static::$MAX_INITIAL_ITEMS_VALUE );
		$random_products = ProductsRepo::generateRandomProducts( static::$MIN_INITIAL_ITEMS_VALUE, $random_max );
		$items = [];

		foreach ( $random_products as $product ) {
			$product_id = $product->getId();
			if ( array_key_exists( $product_id, $items ) ) {
				$items[ $product_id ]++;
			} else {
				$items[ $product_id ] = 1;
			}
		}

		update_user_meta( $this->_wp_user->ID, static::$META_USER_ITEMS, $items );
		update_user_meta( $this->_wp_user->ID, static::$META_USER_ITEMS_GENERATED, true );
	}

	/**
	 * Checks if the initial items for the user have been generated.
	 *
	 * @return bool
	 */
	private function hasItemsGenerated() : bool {
		return get_user_meta( $this->_wp_user->ID, static::$META_USER_ITEMS_GENERATED, true );
	}

}