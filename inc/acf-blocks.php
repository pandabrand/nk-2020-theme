<?php
add_action( 'acf/init', 'nk_acf_init' );

function nk_acf_init() {
	if ( ! function_exists( 'acf_register_block' ) ) {
		return;
	}

	acf_register_block(
		array(
			'name'            => 'text_card',
			'title'           => __( 'Text Card', 'nk-domain' ),
			'description'     => __( 'Card with Title and text', 'nk-domain' ),
			'render_callback' => 'nk_text_card_acf_block_render_callback',
			'category'        => 'formatting',
			'icon'            => 'embed-generic',
			'keywords'        => array( 'cards' ),
		)
	);

	acf_register_block(
		array(
			'name'            => 'modal',
			'title'           => __( 'Modal', 'nk-domain' ),
			'description'     => __( 'Modal with image, title, and text', 'nk-domain' ),
			'render_callback' => 'nk_modal_acf_block_render_callback',
			'category'        => 'formatting',
			'icon'            => 'embed-photo',
			'keywords'        => array( 'cards' ),
		)
	);
}

/**
 *  This is the callback that displays the block.
 *
 * @param   array  $block      The block settings and attributes.
 * @param   string $content    The block content (emtpy string).
 * @param   bool   $is_preview True during AJAX preview.
 */
function nk_text_card_acf_block_render_callback( $block, $content = '', $is_preview = false ) {
	$context               = Timber::context();
	$context['block']      = $block;
	$context['fields']     = get_fields();
	$context['is_preview'] = $is_preview;
	Timber::render( 'templates/block/text-card.twig', $context );
}

/**
 *  This is the callback that displays the block.
 *
 * @param   array  $block      The block settings and attributes.
 * @param   string $content    The block content (emtpy string).
 * @param   bool   $is_preview True during AJAX preview.
 */
function nk_modal_acf_block_render_callback( $block, $content = '', $is_preview = false ) {
	$context                = Timber::context();
	$context['block']       = $block;
	$context['fields']      = get_fields();
	$context['modal_image'] = new Timber\Image( get_field( 'image' ) );
	$context['summary']     = Timber\TextHelper::trim_words( get_field( 'description' ), 45, '...', 'p a span b i br blockqoute' );
	$context['is_preview']  = $is_preview;
	$context['se_active']   = strpos( get_the_permalink(), 'social-ecologies' ) !== false;
	Timber::render( 'templates/block/modal.twig', $context );
}
