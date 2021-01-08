<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * To generate specific templates for your pages you can use:
 * /mytheme/templates/page-mypage.twig
 * (which will still route through this PHP file)
 * OR
 * /mytheme/page-mypage.php
 * (in which case you'll want to duplicate this file and save to the above path)
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */

$context = Timber::context();

$timber_post                  = new Timber\Post();
$context['post']              = $timber_post;
$context['se_active']         = strpos( $timber_post->path(), 'social-ecologies' ) !== false;
$context['sv_active']         = strpos( $timber_post->path(), 'spontaneous-vegetation' ) !== false;
$sidebar_context              = array();
$sidebar_context['post']      = $timber_post;
$sidebar_context['se_active'] = strpos( $timber_post->path(), 'social-ecologies' ) !== false;
$sidebar_context['sv_active'] = strpos( $timber_post->path(), 'spontaneous-vegetation' ) !== false;
$context['sidebar']           = Timber::get_sidebar( 'sidebar.php', $sidebar_context );
Timber::render( array( 'page-se-child' . '.twig', 'page.twig' ), $context );
