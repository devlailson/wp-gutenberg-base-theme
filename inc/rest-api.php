<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Registro da rota REST
 */
function mtb_register_servicos_rest_route() {

	register_rest_route(
		'mtb/v1',
		'/servicos',
		array(
			'methods'  => 'GET',
			'callback' => 'mtb_get_servicos_rest',
			'permission_callback' => '__return_true',
		)
	);

}

add_action( 'rest_api_init', 'mtb_register_servicos_rest_route' );

function mtb_get_servicos_rest() {

	$args = array(
		'post_type'      => 'servico',
		'posts_per_page' => 6,
	);

	$query = new WP_Query( $args );

	$servicos = array();

	while ( $query->have_posts() ) {

		$query->the_post();

		$servicos[] = array(
			'id'        => get_the_ID(),
			'title'     => get_the_title(),
			'excerpt'   => get_the_excerpt(),
			'link'      => get_permalink(),
			'thumbnail' => get_the_post_thumbnail_url( get_the_ID(), 'medium' ),
			'preco'     => get_field( 'preco' ),
			'categoria' => get_field( 'categoria' ),
		);

	}

	wp_reset_postdata();

	return rest_ensure_response( $servicos );

}