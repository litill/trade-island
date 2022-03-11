<?php

namespace TradeIsland\Rest;

/**
 * Base for creating REST input classes.
 */
abstract class Base {

	/**
	 * Custom WP-REST namespace for our app.
	 *
	 * @var string
	 */
	protected string $namespace = 'trade-island/v1';

	/**
	 * Method to register the WP-REST routes.
	 *
	 * @return void
	 */
	abstract public function registerRoutes(): void;

}