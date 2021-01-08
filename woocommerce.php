<?php
if ( ! class_exists( 'Timber' ) ) {
	echo 'Timber not activated. Make sure you activate the plugin in <a href="/wp-admin/plugins.php#timber">/wp-admin/plugins.php</a>.';

	return;
}

$context            = Timber::context();

if ( is_singular( 'product' ) ) {
	$context['post']    = Timber::get_post();
	$product            = wc_get_product( $context['post']->ID );
	$context['product'] = $product;

	// Get related products
	$related_limit               = wc_get_loop_prop( 'columns' );
	$related_ids                 = wc_get_related_products( $context['post']->id, $related_limit );
	$context['related_products'] = Timber::get_posts( $related_ids );

	// Restore the context and loop back to the main query loop.
	wp_reset_postdata();

	Timber::render( 'views/woo/single-product.twig', $context );
} else {
	$posts                             = Timber::get_posts();
	$context['products']               = $posts;
	$sidebar_context                   = array();
	$sidebar_context['title']          = 'Shop';
	$sidebar_context['featured_image'] = get_stylesheet_directory_uri() . ASSET_IMG . asset_path( 'shop-banner.jpg' );
	$sidebar_context['se_active']      = false;
	$sidebar_context['sv_active']      = true;
	$context['sidebar']                = Timber::get_sidebar( 'sidebar.php', $sidebar_context );

	if ( is_product_category() ) {
		$queried_object            = get_queried_object();
		$term_id                   = $queried_object->term_id;
		$context['category']       = get_term( $term_id, 'product_cat' );
		$context['title']          = single_term_title( '', false );
	}

	Timber::render( 'views/woo/archive.twig', $context );
}
