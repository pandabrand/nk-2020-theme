<?php
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );

function timber_set_product( $post ) {
	global $product;

	if ( is_woocommerce() ) {
			$product = wc_get_product( $post->ID );
	}
}
