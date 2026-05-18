<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function mtb_theme_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
		'style',
		'script',
	) );

	add_theme_support( 'custom-logo' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'editor-styles' );

	register_nav_menus( array(
		'primary' => 'Menu principal',
		'footer'  => 'Menu rodapé',
	) );
}
add_action( 'after_setup_theme', 'mtb_theme_setup' );