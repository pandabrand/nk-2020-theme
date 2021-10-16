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
		'add_new_item'          => __( 'Add New NK media', 'nk-media' ),
		'new_item'              => __( 'New NK media', 'nk-media' ),
		'edit_item'             => __( 'Edit NK media', 'nk-media' ),
		'view_item'             => __( 'View NK media', 'nk-media' ),
		'all_items'             => __( 'All NK media', 'nk-media' ),
		'search_items'          => __( 'Search NK media', 'nk-media' ),
		'parent_item_colon'     => __( 'Parent NK media:', 'nk-media' ),
		'not_found'             => __( 'No NK media found.', 'nk-media' ),
		'not_found_in_trash'    => __( 'No NK media found in Trash.', 'nk-media' ),
		'featured_image'        => _x( 'NK Media Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'nk-media' ),
		'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'nk-media' ),
		'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'nk-media' ),
		'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'nk-media' ),
		'archives'              => _x( 'NK Media archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'nk-media' ),
		'insert_into_item'      => _x( 'Insert into NK media', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting NK media into a post). Added in 4.4', 'nk-media' ),
		'uploaded_to_this_item' => _x( 'Uploaded to this NK media', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing NK media attached to a post). Added in 4.4', 'nk-media' ),
		'filter_items_list'     => _x( 'Filter NK media list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'nk-media' ),
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

	$project_labels = array(
		'name'                  => _x( 'Projects', 'Post type general name', 'nk-project' ),
		'singular_name'         => _x( 'Project', 'Post type singular name', 'nk-project' ),
		'menu_name'             => _x( 'NK Project', 'Admin Menu text', 'nk-project' ),
		'name_admin_bar'        => _x( 'NK Project', 'Add New on Toolbar', 'nk-project' ),
		'add_new'               => __( 'Add New', 'nk-project' ),
		'add_new_item'          => __( 'Add New NK project', 'nk-project' ),
		'new_item'              => __( 'New NK project', 'nk-project' ),
		'edit_item'             => __( 'Edit NK project', 'nk-project' ),
		'view_item'             => __( 'View NK project', 'nk-project' ),
		'all_items'             => __( 'All NK projects', 'nk-project' ),
		'search_items'          => __( 'Search NK projects', 'nk-project' ),
		'parent_item_colon'     => __( 'Parent NK project:', 'nk-project' ),
		'not_found'             => __( 'No NK project found.', 'nk-project' ),
		'not_found_in_trash'    => __( 'No NK projects found in Trash.', 'nk-project' ),
		'featured_image'        => _x( 'NK Project Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'nk-project' ),
		'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'nk-project' ),
		'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'nk-project' ),
		'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'nk-project' ),
		'archives'              => _x( 'NK Project archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'nk-project' ),
		'insert_into_item'      => _x( 'Insert into NK project', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting NK project into a post). Added in 4.4', 'nk-project' ),
		'uploaded_to_this_item' => _x( 'Uploaded to this NK project', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing NK project attached to a post). Added in 4.4', 'nk-project' ),
		'filter_items_list'     => _x( 'Filter NK project list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'nk-project' ),
		'items_list_navigation' => _x( 'NK Project list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'nk-project' ),
		'items_list'            => _x( 'NK Project list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'nk-project' ),
	);
	$project_args   = array(
		'labels'             => $project_labels,
		'description'        => 'NK Project custom post type.',
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'spontaneous-vegetation/projects' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 20,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail' ),
		'taxonomies'         => array( 'category', 'post_tag' ),
		'show_in_rest'       => true,
	);

	register_post_type( 'NK Project', $project_args );
}

add_action( 'init', 'nk_custom_post_types_init' );

if ( function_exists( 'acf_add_options_page' ) ) {

	acf_add_options_page(
		array(
			'page_title' => 'Site General Settings',
			'menu_title' => 'Site Settings',
			'menu_slug'  => 'nk-site-general-settings',
			'capability' => 'edit_posts',
			'redirect'   => false,
		)
	);

	acf_add_options_sub_page(
		array(
			'page_title'  => 'Spontaneous Vegetation Settings',
			'menu_title'  => 'Spontaneous Vegetation Settings',
			'parent_slug' => 'nk-sv-settings',
		)
	);

	acf_add_options_sub_page(
		array(
			'page_title'  => 'Social Ecologies Settings',
			'menu_title'  => 'Social Ecologies Settings',
			'parent_slug' => 'nk-se-settings',
		)
	);
}
