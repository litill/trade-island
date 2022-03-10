<?php

namespace TradeIsland\Entities;

class Product {

	/**
	 * Product ID.
	 * @var int
	 */
	private int $ID;

	/**
	 * Product name.
	 * @var string
	 */
	private string $name;

	/**
	 * Product minimum bid price.
	 * @var int
	 */
	private int $min_bid;

	/**
	 * Product constructor.
	 *
	 * @param int $ID
	 * @param string $name
	 * @param int $min_bid
	 */
	public function __construct( int $ID, string $name, int $min_bid ) {
		$this->ID = $ID;
		$this->name = $name;
		$this->min_bid = $min_bid;
	}

	/**
	 * Gets product ID.
	 *
	 * @return int
	 */
	public function getID(): int {
		return $this->ID;
	}

	/**
	 * Gets product name.
	 *
	 * @return string
	 */
	public function getName(): string {
		return $this->name;
	}

	/**
	 * Gets the product minimum bid.
	 *
	 * @return int
	 */
	public function getMinBid(): int {
		return $this->min_bid;
	}
}