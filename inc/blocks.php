<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function mtb_register_theme_blocks() {

	$asset_file = get_template_directory() . '/build/index.asset.php';

	$asset = file_exists( $asset_file )
		? include $asset_file
		: array(
			'dependencies' => array(),
			'version'      => filemtime( get_template_directory() . '/build/index.js' ),
		);

	wp_register_script(
		'mtb-servicos-lista-editor',
		get_template_directory_uri() . '/build/index.js',
		$asset['dependencies'],
		$asset['version'],
		true
	);

	register_block_type(
		get_template_directory() . '/blocks/servicos-lista'
	);

}
add_action( 'init', 'mtb_register_theme_blocks' );