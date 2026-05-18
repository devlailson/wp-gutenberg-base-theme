<?php get_header(); ?>

<div class="container">
	<?php if ( have_posts() ) : ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<?php
			$preco     = function_exists( 'get_field' ) ? get_field( 'preco' ) : '';
			$categoria = function_exists( 'get_field' ) ? get_field( 'categoria' ) : '';
			?>
			<article <?php post_class(); ?>>
				<h1><?php the_title(); ?></h1>

				<?php if ( has_post_thumbnail() ) : ?>
					<div class="single-thumb"><?php the_post_thumbnail( 'large' ); ?></div>
				<?php endif; ?>

				<?php if ( $categoria ) : ?>
					<p><strong>Categoria:</strong> <?php echo esc_html( $categoria ); ?></p>
				<?php endif; ?>

				<?php if ( $preco ) : ?>
					<p><strong>Preço:</strong> R$ <?php echo esc_html( $preco ); ?></p>
				<?php endif; ?>

				<div class="content">
					<?php the_content(); ?>
				</div>
			</article>
		<?php endwhile; ?>
	<?php endif; ?>
</div>

<?php get_footer(); ?>