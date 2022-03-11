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
	 * User items with product data.
	 *
	 * @var UserItem[]
	 */
	private array $_items_with_data = [];

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

		$this->fetchItemsWithProductData();
	}

	/**
	 * Gets raw user items from the user items meta field.
	 *
	 * @return array
	 */
	private function getItems(): array {
		$items = get_user_meta( $this->_wp_user->ID, static::$META_USER_ITEMS, true );

		if ( ! $items ) {
			return [];
		}

		return $items;
	}

	/**
	 * Fetches the user items with product data, the array key is the product id.
	 */
	private function fetchItemsWithProductData(): void {
		$items = $this->getItems();

		if ( ! $items ) {
			return;
		}

		foreach ( $items as $product_id => $quantity ) {
			$this->_items_with_data[ $product_id ] = new UserItem( $product_id, $quantity );
		}
	}

	/**
	 * Gets user items with product data, the array key is the product id.
	 *
	 * @return UserItem[]
	 */
	public function getItemsWithProductData(): array {
		return $this->_items_with_data;
	}

	/**
	 * Checks if all passed items (products with quantities) are in the user's inventory and with enough count.
	 *
	 * @param UserItem[] $requested_items
	 *
	 * @return bool
	 */
	public function areItemsInInventory( array $requested_items ): bool {
		$ok = true;
		foreach ( $requested_items as $requested_item ) {
			if ( ! $this->isItemInInventory( $requested_item ) ) {
				$ok = false;
				break;
			}
		}

		return $ok;
	}

	/**
	 * Checks if the passed item (product with quantity) is in the user's inventory and with enough count.
	 *
	 * @param UserItem $requested_item
	 *
	 * @return bool
	 */
	public function isItemInInventory( UserItem $requested_item ): bool {
		$found_inventory_item = static::pluckInventoryItem( $requested_item, $this->_items_with_data );

		if ( ! $found_inventory_item ) {
			return false;
		}

		return static::checkItemQuantity( $requested_item, $found_inventory_item );
	}

	/**
	 * Gets the User inventory item information of a specified item (compares the inventory item's Product ID)
	 *
	 * @param UserItem $requested_item
	 * @param UserItem[] $inventory
	 *
	 * @return UserItem|null
	 */
	public static function pluckInventoryItem( UserItem $requested_item, array $inventory ): ?UserItem {
		$found = array_filter(  $inventory, fn( UserItem $item ) => $item->getProductID() === $requested_item->getProductID() );

		if ( ! count( $found ) ) {
			return null;
		}

		return array_pop( $found );
	}

	/**
	 * Checks if the user has enough of the requested product's quantity in his inventory.
	 *
	 * @param UserItem $requested_item
	 * @param UserItem $inventory_item
	 *
	 * @return bool
	 */
	public static function checkItemQuantity( UserItem $requested_item, UserItem $inventory_item ): bool {
		return $inventory_item->getQuantity() >= $requested_item->getQuantity();
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