<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function mtb_shortcode_servicos( $atts ) {
	$atts = shortcode_atts(
		array(
			'quantidade' => 6,
			'destaque'   => '',
		),
		$atts,
		'servicos'
	);

	$args = array(
		'post_type'      => 'servico',
		'posts_per_page' => intval( $atts['quantidade'] ),
	);

	if ( $atts['destaque'] === 'sim' ) {
		$args['meta_query'] = array(
			array(
				'key'     => 'destaque',
				'value'   => '1',
				'compare' => '=',
			),
		);
	}

	$query = new WP_Query( $args );

	ob_start();

	if ( $query->have_posts() ) {
		echo '<div class="grid-servicos">';

		while ( $query->have_posts() ) {
			$query->the_post();

			$preco     = function_exists( 'get_field' ) ? get_field( 'preco' ) : '';
			$categoria = function_exists( 'get_field' ) ? get_field( 'categoria' ) : '';

			?>
			<article class="card-servico">
				<?php if ( has_post_thumbnail() ) : ?>
					<div class="thumb">
						<?php the_post_thumbnail( 'medium' ); ?>
					</div>
				<?php endif; ?>

				<h3>
					<a href="<?php the_permalink(); ?>">
						<?php the_title(); ?>
					</a>
				</h3>

				<?php the_excerpt(); ?>

				<?php if ( $categoria ) : ?>
					<p><strong>Categoria:</strong> <?php echo esc_html( $categoria ); ?></p>
				<?php endif; ?>

				<?php if ( $preco ) : ?>
					<p><strong>Preço:</strong> R$ <?php echo esc_html( $preco ); ?></p>
				<?php endif; ?>
			</article>
			<?php
		}

		echo '</div>';

		wp_reset_postdata();
	} else {
		echo '<p>Nenhum serviço encontrado.</p>';
	}

	return ob_get_clean();
}
add_shortcode( 'servicos', 'mtb_shortcode_servicos' );