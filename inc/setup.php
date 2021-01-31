<?php

function s_e2020_register_nav_menu() {
		register_nav_menus(
			array(
				'social_ecologies_menu'       => __( 'Social Ecologies Menu', 'se20202_domain' ),
				'spontaneous_vegetation_menu' => __( 'Spontaneous Vegetation Menu', 'se20202_domain' ),
			)
		);
}

add_action( 'after_setup_theme', 's_e2020_register_nav_menu', 0 );

function s_e2020_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Footer', 'se20202_domain' ),
			'id'            => 'footer-1',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);
}

add_action( 'widgets_init', 's_e2020_widgets_init' );

function theme_add_woocommerce_support() {
	add_theme_support( 'woocommerce' );
}

add_action( 'after_setup_theme', 'theme_add_woocommerce_support' );


function s_e2020_template( $template ) {
	global $post;

	$parent = ( $post && $post->post_parent ) ? get_post( $post->post_parent ) : null;

	if ( ! empty( $parent ) && 'social-ecologies' === $parent->post_name ) {
		$template = locate_template( 'template-social-ecologies.php' );
	}

	return $template;
}

add_filter( 'template_include', 's_e2020_template', 99 );

function nk_custom_post_types_init() {
	$labels = array(
		'name'                  => _x( 'Media', 'Post type general name', 'nk-media' ),
		'singular_name'         => _x( 'Media', 'Post type singular name', 'nk-media' ),
		'menu_name'             => _x( 'NK Media', 'Admin Menu text', 'nk-media' ),
		'name_admin_bar'        => _x( 'NK Media', 'Add New on Toolbar', 'nk-media' ),
		'add_new'               => __( 'Add New', 'nk-media' ),
		'add_new_item'          => __( 'Add New nk media', 'nk-media' ),
		'new_item'              => __( 'New nk media', 'nk-media' ),
		'edit_item'             => __( 'Edit nk media', 'nk-media' ),
		'view_item'             => __( 'View nk media', 'nk-media' ),
		'all_items'             => __( 'All nk media', 'nk-media' ),
		'search_items'          => __( 'Search nk media', 'nk-media' ),
		'parent_item_colon'     => __( 'Parent nk media:', 'nk-media' ),
		'not_found'             => __( 'No nk media found.', 'nk-media' ),
		'not_found_in_trash'    => __( 'No nk media found in Trash.', 'nk-media' ),
		'featured_image'        => _x( 'NK Media Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'nk-media' ),
		'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'nk-media' ),
		'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'nk-media' ),
		'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'nk-media' ),
		'archives'              => _x( 'NK Media archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'nk-media' ),
		'insert_into_item'      => _x( 'Insert into nk media', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting nk media into a post). Added in 4.4', 'nk-media' ),
		'uploaded_to_this_item' => _x( 'Uploaded to this nk media', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing nk media attached to a post). Added in 4.4', 'nk-media' ),
		'filter_items_list'     => _x( 'Filter nk media list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'nk-media' ),
		'items_list_navigation' => _x( 'NK Media list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'nk-media' ),
		'items_list'            => _x( 'NK Media list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'nk-media' ),
	);
	$args   = array(
		'labels'             => $labels,
		'description'        => 'NK Media custom post type.',
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'spontaneous-vegetation/media' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 20,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail' ),
		'taxonomies'         => array( 'category', 'post_tag' ),
		'show_in_rest'       => true,
	);

	register_post_type( 'NK Media', $args );
}
add_action( 'init', 'nk_custom_post_types_init' );
