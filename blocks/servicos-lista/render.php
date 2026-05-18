<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$query = new WP_Query( array(
	'post_type'      => 'servico',
	'posts_per_page' => 6,
) );

if ( ! $query->have_posts() ) {
	echo '<p>Nenhum serviço encontrado.</p>';
	return;
}

echo '<div class="grid-servicos">';

while ( $query->have_posts() ) {
	$query->the_post();

	$preco     = function_exists( 'get_field' ) ? get_field( 'preco' ) : '';
	$categoria = function_exists( 'get_field' ) ? get_field( 'categoria' ) : '';

	echo '<article class="card-servico">';

	if ( has_post_thumbnail() ) {
		echo '<div class="thumb">';
		the_post_thumbnail( 'medium' );
		echo '</div>';
	}

	echo '<h3><a href="' . esc_url( get_permalink() ) . '">' . esc_html( get_the_title() ) . '</a></h3>';

	echo '<div class="resumo">';
	the_excerpt();
	echo '</div>';

	if ( $categoria ) {
		echo '<p><strong>Categoria:</strong> ' . esc_html( $categoria ) . '</p>';
	}

	if ( $preco ) {
		echo '<p><strong>Preço:</strong> R$ ' . esc_html( $preco ) . '</p>';
	}

	echo '</article>';
}

echo '</div>';

wp_reset_postdata();