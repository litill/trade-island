<?php
/**
 * Plugin Name:       Trade Island
 * Plugin URI:        https://example.com/plugins/the-basics/
 * Description:       Handle the basics with this plugin.
 * Version:           0.1
 * Requires at least: 5.2
 * Requires PHP:      7.4
 * Author:            Grzegorz Jasiński
 * Author URI:        https://www.polcode.com
 * Text Domain:       trade-island
 * Domain Path:       /languages
 */

use TradeIsland\Core;

require_once( dirname(__FILE__) . '/vendor/autoload.php' );

/**
 * Let's get it started.
 */
global $trade_island;
$trade_island = new Core();