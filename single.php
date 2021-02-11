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

$context                  = Timber::context();
$timber_post              = Timber::get_post();
$context['post']          = $timber_post;
$sidebar_context          = array();
$sidebar_context['title'] = $timber_post->post_title;

if ( 'nkmedia' === $timber_post->post_type && ! has_post_thumbnail() ) {
	$nk_media_image                    = get_field( 'nk_media_featured_image', 'option' );
	$sidebar_context['featured_image'] = new Timber\Image( $nk_media_image );
} elseif ( 'post' === $timber_post->post_type && ! has_post_thumbnail() ) {
	$writings_image                    = get_field( 'writings_featured_image', 'option' );
	$sidebar_context['featured_image'] = new Timber\Image( $writings_image );
}

$sidebar_context['se_active'] = false;
$sidebar_context['sv_active'] = true;

$context['sidebar'] = Timber::get_sidebar( 'sidebar.php', $sidebar_context );

if ( post_password_required( $timber_post->ID ) ) {
	Timber::render( 'single-password.twig', $context );
} else {
	Timber::render( array( 'single-' . $timber_post->ID . '.twig', 'single-' . $timber_post->post_type . '.twig', 'single-' . $timber_post->slug . '.twig', 'single.twig' ), $context );
}
