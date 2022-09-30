<?php 
//Add support for custom nav menus
add_theme_support( 'nav-menus' );

################################################################################
// Register the navigation menus
################################################################################
register_nav_menus( array(
	'primary' => __( 'Main Navigation' ),
	'footer_menu' => __('Footer Navigation')
) );

?>