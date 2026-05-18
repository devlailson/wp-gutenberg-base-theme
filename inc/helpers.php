<?php
function mtb_filtrar_servicos_archive( $query ) {
	if ( is_admin() || ! $query->is_main_query() ) {
		return;
	}

	if ( is_post_type_archive( 'servico' ) ) {
		$meta_query = array();

		if ( ! empty( $_GET['categoria'] ) ) {
			$meta_query[] = array(
				'key'     => 'categoria',
				'value'   => sanitize_text_field( $_GET['categoria'] ),
				'compare' => '=',
			);
		}

		if ( ! empty( $_GET['preco_max'] ) ) {
			$meta_query[] = array(
				'key'     => 'preco',
				'value'   => floatval( $_GET['preco_max'] ),
				'type'    => 'NUMERIC',
				'compare' => '<=',
			);
		}

		if ( ! empty( $_GET['destaque'] ) && $_GET['destaque'] === '1' ) {
			$meta_query[] = array(
				'key'     => 'destaque',
				'value'   => '1',
				'compare' => '=',
			);
		}

		if ( ! empty( $meta_query ) ) {
			$query->set( 'meta_query', $meta_query );
		}

		if ( ! empty( $_GET['ordem'] ) ) {
			if ( $_GET['ordem'] === 'menor_preco' ) {
				$query->set( 'meta_key', 'preco' );
				$query->set( 'orderby', 'meta_value_num' );
				$query->set( 'order', 'ASC' );
			}

			if ( $_GET['ordem'] === 'maior_preco' ) {
				$query->set( 'meta_key', 'preco' );
				$query->set( 'orderby', 'meta_value_num' );
				$query->set( 'order', 'DESC' );
			}
		}

		$query->set( 'posts_per_page', 6 );
	}
}
add_action( 'pre_get_posts', 'mtb_filtrar_servicos_archive' );