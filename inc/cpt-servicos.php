<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function mtb_register_cpt_servicos() {
	$labels = array(
		'name'               => 'Serviços',
		'singular_name'      => 'Serviço',
		'add_new'            => 'Adicionar novo',
		'add_new_item'       => 'Adicionar novo serviço',
		'edit_item'          => 'Editar serviço',
		'new_item'           => 'Novo serviço',
		'view_item'          => 'Ver serviço',
		'search_items'       => 'Buscar serviços',
		'not_found'          => 'Nenhum serviço encontrado',
		'not_found_in_trash' => 'Nenhum serviço encontrado na lixeira',
	);

	$args = array(
		'labels'       => $labels,
		'public'       => true,
		'menu_icon'    => 'dashicons-hammer',
		'has_archive'  => true,
		'rewrite'      => array( 'slug' => 'servicos' ),
		'supports'     => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
		'show_in_rest' => true,
	);

	register_post_type( 'servico', $args );
}
add_action( 'init', 'mtb_register_cpt_servicos' );