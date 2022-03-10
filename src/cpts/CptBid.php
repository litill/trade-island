<?php

namespace TradeIsland\CPTS;

class CptBid {

	public function __construct() {
		add_action( 'init', [ $this, 'registerCPT' ], 0 );
	}

	public function registerCPT() {
		$labels = array(
			'name'                  => _x( 'Bids', 'Post Type General Name', 'trade-island' ),
			'singular_name'         => _x( 'Bid', 'Post Type Singular Name', 'trade-island' ),
			'menu_name'             => __( 'Bids', 'trade-island' ),
			'name_admin_bar'        => __( 'Bid', 'trade-island' ),
			'archives'              => __( 'Bids Archives', 'trade-island' ),
			'attributes'            => __( 'Bid Attributes', 'trade-island' ),
			'parent_item_colon'     => __( 'Parent Item:', 'trade-island' ),
			'all_items'             => __( 'All Items', 'trade-island' ),
			'add_new_item'          => __( 'Add New Item', 'trade-island' ),
			'add_new'               => __( 'Add New', 'trade-island' ),
			'new_item'              => __( 'New Bid', 'trade-island' ),
			'edit_item'             => __( 'Edit Bid', 'trade-island' ),
			'update_item'           => __( 'Update Bid', 'trade-island' ),
			'view_item'             => __( 'View Bid', 'trade-island' ),
			'view_items'            => __( 'View Bids', 'trade-island' ),
			'search_items'          => __( 'Search Bids', 'trade-island' ),
			'not_found'             => __( 'Not found', 'trade-island' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'trade-island' ),
			'featured_image'        => __( 'Featured Image', 'trade-island' ),
			'set_featured_image'    => __( 'Set featured image', 'trade-island' ),
			'remove_featured_image' => __( 'Remove featured image', 'trade-island' ),
			'use_featured_image'    => __( 'Use as featured image', 'trade-island' ),
			'insert_into_item'      => __( 'Insert into bid', 'trade-island' ),
			'uploaded_to_this_item' => __( 'Uploaded to this item', 'trade-island' ),
			'items_list'            => __( 'Items list', 'trade-island' ),
			'items_list_navigation' => __( 'Items list navigation', 'trade-island' ),
			'filter_items_list'     => __( 'Filter items list', 'trade-island' ),
		);

		$args = array(
			'label'                 => __( 'Bid', 'trade-island' ),
			'description'           => __( 'Bids', 'trade-island' ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'custom-fields' ),
			'taxonomies'            => array( 'category', 'post_tag' ),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 5,
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => false,
			'exclude_from_search'   => true,
			'publicly_queryable'    => true,
			'capability_type'       => 'page',
			'show_in_rest'          => false,
		);

		register_post_type( 'ti_bid', $args );
	}
}
