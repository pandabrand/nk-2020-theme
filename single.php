<?php
/**
 * The Template for displaying all single posts
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */

$context         = Timber::context();
$timber_post     = Timber::get_post();
$context['post'] = $timber_post;
$sidebar_context = array();

// if ( 'mec-events' === $timber_post->post_type ) {
	// $page                              = get_page_by_path( 'calendar' );
	// $sidebar_context['featured_image'] = new Timber\Image( get_post_thumbnail_id( $page->ID ) );
	// $sidebar_context['title']          = $timber_post->post_title;
	// $sidebar_context['type']           = $timber_post->post_type;
// }

// $context['sidebar'] = Timber::get_sidebar( 'sidebar.php', $sidebar_context );

if ( post_password_required( $timber_post->ID ) ) {
	Timber::render( 'single-password.twig', $context );
} else {
	Timber::render( array( 'single-' . $timber_post->ID . '.twig', 'single-' . $timber_post->post_type . '.twig', 'single-' . $timber_post->slug . '.twig', 'single.twig' ), $context );
}
