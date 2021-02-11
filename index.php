<?php
/**
 * The main template file
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since   Timber 0.1
 */

$context          = Timber::context();
$context['posts'] = new Timber\PostQuery();
$templates        = array( 'index.twig' );

$title     = 'Archive';
$post_type = get_post_type();

switch ( $post_type ) {
	case 'nkmedia':
		$title = 'Media';
		break;

	case 'mce-events':
		$title = 'Calendar';
		break;

	default:
		$title = 'Writings';
}

$sidebar_context          = array();
$sidebar_context['title'] = $title;

if ( 'nkmedia' === get_post_type() ) {
	$nk_media_image                    = get_field( 'nk_media_featured_image', 'option' );
	$sidebar_context['featured_image'] = new Timber\Image( $nk_media_image );
} elseif ( 'post' === get_post_type() ) {
	$writings_image                    = get_field( 'writings_featured_image', 'option' );
	$sidebar_context['featured_image'] = new Timber\Image( $writings_image );
} else {
	$default_image                     = get_field( 'nk_media_featured_image', 'option' );
	$sidebar_context['featured_image'] = new Timber\Image( $default_image );
}

$archive_url                  = get_post_type_archive_link( get_post_type() );
$sidebar_context['se_active'] = strpos( $archive_url, 'social-ecologies' ) !== false;
$sidebar_context['sv_active'] = strpos( $archive_url, 'spontaneous-vegetation' ) !== false || 'mce-event' === get_post_type();

$context['sidebar'] = Timber::get_sidebar( 'sidebar.php', $sidebar_context );

if ( is_home() ) {
	array_unshift( $templates, 'front-page.twig', 'home.twig' );
}
Timber::render( $templates, $context );
