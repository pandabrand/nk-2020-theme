<?php
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );

function timber_set_product( $post ) {
	global $product;

	if ( is_woocommerce() ) {
			$product = wc_get_product( $post->ID );
	}
}

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );

add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );

function woo_remove_product_tabs( $tabs ) {
		unset( $tabs['reviews'] );
		unset( $tabs['additional_information'] );

		return $tabs;
}

function allow_personal_uploads( $existing_mimes = array() ) {
	// allow uploading .MOBI and .EPUB files
	$existing_mimes['mobi'] = 'application/x-mobipocket-ebook';
	$existing_mimes['epub'] = 'application/epub+zip';

	// return amended array
	return $existing_mimes;
}

add_filter( 'upload_mimes', 'allow_personal_uploads' );
