<?php get_header(); ?>

<div class="container">
	<h1>Serviços</h1>

	<form method="get" class="filtro-servicos">

		<select name="categoria">
			<option value="">Todas as categorias</option>
			<option value="design" <?php selected( $_GET['categoria'] ?? '', 'design' ); ?>>Design</option>
			<option value="desenvolvimento" <?php selected( $_GET['categoria'] ?? '', 'desenvolvimento' ); ?>>Desenvolvimento</option>
			<option value="marketing" <?php selected( $_GET['categoria'] ?? '', 'marketing' ); ?>>Marketing</option>
		</select>

		<input
			type="number"
			name="preco_max"
			placeholder="Preço máximo"
			value="<?php echo esc_attr( $_GET['preco_max'] ?? '' ); ?>"
		>

		<select name="destaque">
			<option value="">Todos</option>
			<option value="1" <?php selected( $_GET['destaque'] ?? '', '1' ); ?>>Somente destaques</option>
		</select>

		<select name="ordem">
			<option value="">Ordenar</option>
			<option value="menor_preco" <?php selected( $_GET['ordem'] ?? '', 'menor_preco' ); ?>>Menor preço</option>
			<option value="maior_preco" <?php selected( $_GET['ordem'] ?? '', 'maior_preco' ); ?>>Maior preço</option>
		</select>

		<button type="submit">Filtrar</button>

	</form>

	<div class="grid-servicos">
		<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php
				$preco     = function_exists( 'get_field' ) ? get_field( 'preco' ) : '';
				$categoria = function_exists( 'get_field' ) ? get_field( 'categoria' ) : '';
				$destaque  = function_exists( 'get_field' ) ? get_field( 'destaque' ) : '';
				?>
				<article <?php post_class( 'card-servico' ); ?>>
					<?php if ( has_post_thumbnail() ) : ?>
						<div class="thumb"><?php the_post_thumbnail( 'medium' ); ?></div>
					<?php endif; ?>

					<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

					<div class="content"><?php the_excerpt(); ?></div>

					<?php if ( $categoria ) : ?>
						<p><strong>Categoria:</strong> <?php echo esc_html( $categoria ); ?></p>
					<?php endif; ?>

					<?php if ( $preco ) : ?>
						<p><strong>Preço:</strong> R$ <?php echo esc_html( $preco ); ?></p>
					<?php endif; ?>

					<?php if ( $destaque ) : ?>
						<span class="badge">Destaque</span>
					<?php endif; ?>
				</article>
			<?php endwhile; ?>

			<div class="pagination">
				<?php the_posts_pagination(); ?>
			</div>
		<?php else : ?>
			<p>Nenhum serviço encontrado.</p>
		<?php endif; ?>
	</div>
</div>

<?php get_footer(); ?>