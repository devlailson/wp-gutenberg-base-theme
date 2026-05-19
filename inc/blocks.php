<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function mtb_register_theme_blocks() {

	wp_register_script(
		'mtb-servicos-lista-editor',
		get_template_directory_uri() . '/blocks/servicos-lista/index.js',
		array( 'wp-blocks', 'wp-element', 'wp-components', 'wp-block-editor', 'wp-api-fetch' ),
		filemtime( get_template_directory() . '/blocks/servicos-lista/index.js' ),
		true
	);

	register_block_type( get_template_directory() . '/blocks/servicos-lista' );

}
add_action( 'init', 'mtb_register_theme_blocks' );