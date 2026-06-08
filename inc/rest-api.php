<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function mtb_register_servicos_rest_route() {

	register_rest_route(
		'mtb/v1',
		'/servicos',
		array(
			'methods'             => 'GET',
			'callback'            => 'mtb_get_servicos_rest',
			'permission_callback' => '__return_true',
			'args'                => array(
				'quantidade' => array(
					'default'           => 6,
					'sanitize_callback' => 'absint',
				),
				'destaque' => array(
					'default'           => false,
					'sanitize_callback' => 'rest_sanitize_boolean',
				),
				'categoria' => array(
					'default'           => '',
					'sanitize_callback' => 'sanitize_text_field',
				),
			),
		)
	);

	register_rest_route(
		'mtb/v1',
		'/categorias',
		array(
			'methods'             => 'GET',
			'callback'            => 'mtb_get_categorias_rest',
			'permission_callback' => '__return_true',
		)
	);

}
add_action( 'rest_api_init', 'mtb_register_servicos_rest_route' );

function mtb_get_servicos_rest( WP_REST_Request $request ) {

	$quantidade = $request->get_param( 'quantidade' );
	$destaque   = $request->get_param( 'destaque' );
	$categoria  = $request->get_param( 'categoria' );
	$args = array(
		'post_type'      => 'servico',
		'posts_per_page' => $quantidade ? $quantidade : 6,
		'post_status'    => 'publish',
		'meta_query'     => array(),
	);

	if ( $destaque ) {
		$args['meta_query'][] = array(
			'key'     => 'destaque',
			'value'   => '1',
			'compare' => '=',
		);
	}

	if ( $categoria ) {

		$args['meta_query'][] = array(
			'key'     => 'categoria',
			'value'   => $categoria,
			'compare' => '=',
		);
	}

	$query = new WP_Query( $args );

	$servicos = array();

	while ( $query->have_posts() ) {
		$query->the_post();

		$servicos[] = array(
			'id'        => get_the_ID(),
			'title'     => get_the_title(),
			'excerpt'   => wp_strip_all_tags( get_the_excerpt() ),
			'link'      => get_permalink(),
			'thumbnail' => get_the_post_thumbnail_url( get_the_ID(), 'medium' ),
			'preco'     => function_exists( 'get_field' ) ? get_field( 'preco' ) : '',
			'categoria' => function_exists( 'get_field' ) ? get_field( 'categoria' ) : '',
			'destaque'  => function_exists( 'get_field' ) ? (bool) get_field( 'destaque' ) : false,
		);
	}

	wp_reset_postdata();

	return rest_ensure_response( $servicos );

}

function mtb_get_categorias_rest() {

	global $wpdb;

	$categorias = $wpdb->get_col(
		"
		SELECT DISTINCT meta_value
		FROM {$wpdb->postmeta}
		WHERE meta_key = 'categoria'
		AND meta_value != ''
		"
	);

	return rest_ensure_response( $categorias );

}