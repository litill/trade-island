<?php

namespace TradeIsland\Entities;

use TradeIsland\Repos\ProductsRepo;

class UserItem {

	private int $quantity;
	private Product $product;
	private int $total;

	/**
	 * @param $product_id
	 * @param $quantity
	 *
	 * @return void
	 */
	public function __construct( $product_id, $quantity ) {
		$this->product = ProductsRepo::getInstance()->getByID( $product_id );
		$this->quantity = $quantity;
		$this->total = $quantity * $this->product->getMinBid();
	}

	public function getQuantity(): int {
		return $this->quantity;
	}

	public function getProductName(): string {
		return $this->product->getName();
	}

	public function getTotal(): int {
		return $this->total;
	}

}