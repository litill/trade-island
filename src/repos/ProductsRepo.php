<?php

namespace TradeIsland\Repos;

use Exception;
use TradeIsland\Entities\Product;

class ProductsRepo {

	private static ProductsRepo $_instance;

	/**
	 * Available products.
	 *
	 * @var array
	 */
	private array $_products;

	/**
	 * Products repo constructor.
	 */
	protected function __construct() {
		$this->waterTheRepo();
	}

	public static function getInstance(): ProductsRepo {
		$cls = static::class;
		if ( ! isset( self::$_instance ) ) {
			self::$_instance = new static();
		}

		return self::$_instance;
	}

	/**
	 * Inserts the products to the repository.
	 *
	 * @return void
	 */
	private function waterTheRepo(): void {
		$this->_products = [];

		array_push($this->_products,
			new Product( 1,'Water', 1 ),
			new Product( 2,'Shirt', 3 ),
			new Product( 3,'Pants', 4 ),
			new Product( 4,'Dog', 5 ),
			new Product( 5,'Soup', 8 ),
			new Product( 6,'BE developer', 10 )
		);
	}

	/**
	 * Gets all products.
	 * @return Product[]
	 */
	public function getAll(): array {
		return $this->_products;
	}

	/**
	 * Gets product by Product ID.
	 *
	 * @param int $ID
	 *
	 * @return Product|null
	 */
	public function getByID( int $ID ): ?Product {
		$found = array_filter( $this->_products, fn ( Product $product ) => $product->getID() === $ID );
		return count( $found ) ? array_pop( $found ) : null;
	}

	/**
	 * Generates random products list that sum up to not more than the given max of points.
	 *
	 * @param int $max_points
	 *
	 * @return Product[] | null
	 *
	 * @todo this should be more fair
	 */
	public static function generateRandomProducts( int $min_points, int $max_points ): ?array {
		$available_products = static::getInstance()->getAll();

		if ( ! count( $available_products ) ) {
			return null;
		}

		$stop_generating = false;
		$tmp_products = [];

		while ( ! $stop_generating ) {
			$random_product_idx = rand( 0, count( $available_products ) - 1 );
			$random_product = $available_products[ $random_product_idx ];
			$value_count = array_reduce( $tmp_products, fn( $total, Product $product ) => $total + $product->getMinBid(), 0 );

			if ( $value_count + $random_product->getMinBid() >= $max_points && $value_count >= $min_points ) {
				$stop_generating = true;
				continue;
			}

			$tmp_products[] = $random_product;
		}

		return $tmp_products;
	}


	/**
	 * Protect from cloning.
	 *
	 * @return void
	 */
	protected function __clone() { }

	/**
	 * Protect from wakeup.
	 *
	 * @throws Exception
	 */
	public function __wakeup() {
		throw new Exception("Cannot unserialize a singleton.");
	}

}