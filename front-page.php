<?php get_header(); ?>

<section class="hero">
	<div class="container">
		<h1>Meu Tema Base WordPress</h1>
		<p>Base personalizada para estudar Gutenberg, ACF, hooks e engenharia WordPress.</p>
	</div>
</section>

<section class="container">
	<h2>Últimos conteúdos</h2>

	<?php
	$query = new WP_Query( array(
		'post_type'      => 'post',
		'posts_per_page' => 3,
	) );

	if ( $query->have_posts() ) :
		while ( $query->have_posts() ) :
			$query->the_post();
			?>
			<article>
				<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
				<?php the_excerpt(); ?>
			</article>
			<?php
		endwhile;
		wp_reset_postdata();
	else :
		echo '<p>Nenhum post encontrado.</p>';
	endif;
	?>
</section>

<?php get_footer(); ?>