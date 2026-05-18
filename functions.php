<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require get_template_directory() . '/inc/setup.php';
require get_template_directory() . '/inc/enqueue.php';
require get_template_directory() . '/inc/cpt-servicos.php';
require get_template_directory() . '/inc/acf-fields.php';
require get_template_directory() . '/inc/helpers.php';
require get_template_directory() . '/inc/shortcodes.php';
require get_template_directory() . '/inc/rest-api.php';
require get_template_directory() . '/inc/blocks.php';