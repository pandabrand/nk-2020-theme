<?php

function s_e_2020_enqueue() {
	wp_enqueue_script( 'se2020-js', get_stylesheet_directory_uri() . ASSET_JS . asset_path( 'site.js' ), array(), null, true );
	wp_enqueue_script( 'alpine-js', 'https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.0/dist/alpine.min.js', array(), null, true );
}
add_action( 'wp_enqueue_scripts', 's_e_2020_enqueue' );
