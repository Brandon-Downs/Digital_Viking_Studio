<?php 

################################################################################
//	Function: get_dynamic_sidebar
//	Description: Returns the content of a dynamic sidebar without printing it
//	Parameters: $index(string | int) = the id of the dynamic sidebar
//		Default: 1
//	Usage: get_dynamic_sidebar(1); OR get_dynamic_sidebar('sidebar_name');
################################################################################
function get_dynamic_sidebar($index = 1) 
{
	$sidebar_contents = "";
	ob_start();
	dynamic_sidebar($index);
	$sidebar_contents = ob_get_contents();
	ob_end_clean();
	
	return $sidebar_contents;
}

################################################################################
// Add theme sidebars
################################################################################

if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
	  	'name' => __( 'Primary Sidebar' ),
		'id' => 'primary-sidebar',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget_title">',
        'after_title' => '</h3>',
	));
	
	register_sidebar(array(
	  	'name' => __( 'Contact Info' ),
		'id' => 'contact',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget_title">',
        'after_title' => '</h3>',
	));

	register_sidebar(array(
	  	'name' => __( 'Copyright' ),
		'id' => 'copyright',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="invisible">',
        'after_title' => '</h3>',
	));
}

?>