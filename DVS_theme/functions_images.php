<?php 
/* Commonly used functions:  , array( 'post', 'page' )*/
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 324, 324, true ); 


	/* Cropped Images */
	add_image_size('fullBanner', 1600, 600, true);	

	/* Uncropped */
	add_image_size('medSq', 300, 300, false);
	
	/* Cubes */
    add_image_size('recent_posts_widget', 100, 100, true);

	//add_image_size( 'single-post-thumbnail', 160, 100, true ); 
	//add_image_size('index-categories', 150, 150, true);
    //add_image_size('page-single', 350, 350, true);

	//Add custom sizes to media uploader
	// function add_custom_sizes( $imageSizes ) {
	// 	$my_sizes = array(
	// 	'events-members' => 'Medium Thumbnail'
	// 	);
	// 	return array_merge( $imageSizes, $my_sizes );
	// }
	// add_filter( 'image_size_names_choose', 'add_custom_sizes' );

?>