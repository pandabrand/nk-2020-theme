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

	$parent = ( $post->post_parent ) ? get_post( $post->post_parent ) : null;

	if ( ! empty( $parent ) && 'social-ecologies' === $parent->post_name ) {
		$template = locate_template( 'template-social-ecologies.php' );
	}

	return $template;
}

add_filter( 'template_include', 's_e2020_template', 99 );
