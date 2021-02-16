<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since   Timber 0.2
 */

$templates = array( 'archive.twig', 'index.twig' );

$context = Timber::context();

// $context['title'] = 'Archive';
$title = 'Archive';
if ( is_day() ) {
	$title = 'Archive: ' . get_the_date( 'D M Y' );
} elseif ( is_month() ) {
	$title = 'Archive: ' . get_the_date( 'M Y' );
} elseif ( is_year() ) {
	$title = 'Archive: ' . get_the_date( 'Y' );
} elseif ( is_tag() ) {
	$title = single_tag_title( '', false );
} elseif ( is_category() ) {
	$title = single_cat_title( '', false );
	array_unshift( $templates, 'archive-' . get_query_var( 'cat' ) . '.twig' );
} elseif ( is_post_type_archive() ) {
	$title = post_type_archive_title( '', false );
	array_unshift( $templates, 'archive-' . get_post_type() . '.twig' );
}

$sidebar_context          = array();
$sidebar_context['title'] = $title;
$context['sidebar_class'] = get_post_type();

if ( 'nkmedia' === get_post_type() ) {
	$nk_media_image                    = get_field( 'nk_media_featured_image', 'option' );
	$sidebar_context['featured_image'] = new Timber\Image( $nk_media_image );
} elseif ( 'nkproject' === get_post_type() ) {
	$nk_project_image                  = get_field( 'nk_project_featured_image', 'option' );
	$sidebar_context['featured_image'] = new Timber\Image( $nk_project_image );
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

$context['posts'] = new Timber\PostQuery();

Timber::render( $templates, $context );
