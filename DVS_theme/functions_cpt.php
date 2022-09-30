<?php 
/* 
** For more information about Custom Post Types and Taxonomies see http://codex.wordpress.org/Function_Reference/register_post_type
** and http://codex.wordpress.org/Function_Reference/register_taxonomy
**
*/

//Register Taxonomy - example 2021
/**
 * Replace toolset types with this when there is a dash and CPT UI won't allow you to recreate the matching slug
 * Create two taxonomies, genres and writers for the post type "book".
 *
 * @see register_post_type() for registering custom post types.

function wpdocs_create_book_taxonomies() {
    // Add new taxonomy, make it hierarchical (like categories)
    $labels = array(
        'name'              => _x( 'Genres', 'taxonomy general name', 'textdomain' ),
        'singular_name'     => _x( 'Genre', 'taxonomy singular name', 'textdomain' ),
        'search_items'      => __( 'Search Genres', 'textdomain' ),
        'all_items'         => __( 'All Genres', 'textdomain' ),
        'parent_item'       => __( 'Parent Genre', 'textdomain' ),
        'parent_item_colon' => __( 'Parent Genre:', 'textdomain' ),
        'edit_item'         => __( 'Edit Genre', 'textdomain' ),
        'update_item'       => __( 'Update Genre', 'textdomain' ),
        'add_new_item'      => __( 'Add New Genre', 'textdomain' ),
        'new_item_name'     => __( 'New Genre Name', 'textdomain' ),
        'menu_name'         => __( 'Genre', 'textdomain' ),
    );
 
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'genre' ),
    );
 
    register_taxonomy( 'genre', array( 'book' ), $args );
 
    unset( $args );
    unset( $labels );
 
    // Add new taxonomy, NOT hierarchical (like tags)
    $labels = array(
        'name'                       => _x( 'Writers', 'taxonomy general name', 'textdomain' ),
        'singular_name'              => _x( 'Writer', 'taxonomy singular name', 'textdomain' ),
        'search_items'               => __( 'Search Writers', 'textdomain' ),
        'popular_items'              => __( 'Popular Writers', 'textdomain' ),
        'all_items'                  => __( 'All Writers', 'textdomain' ),
        'parent_item'                => null,
        'parent_item_colon'          => null,
        'edit_item'                  => __( 'Edit Writer', 'textdomain' ),
        'update_item'                => __( 'Update Writer', 'textdomain' ),
        'add_new_item'               => __( 'Add New Writer', 'textdomain' ),
        'new_item_name'              => __( 'New Writer Name', 'textdomain' ),
        'separate_items_with_commas' => __( 'Separate writers with commas', 'textdomain' ),
        'add_or_remove_items'        => __( 'Add or remove writers', 'textdomain' ),
        'choose_from_most_used'      => __( 'Choose from the most used writers', 'textdomain' ),
        'not_found'                  => __( 'No writers found.', 'textdomain' ),
        'menu_name'                  => __( 'Writers', 'textdomain' ),
    );
 
    $args = array(
        'hierarchical'          => false,
        'labels'                => $labels,
        'show_ui'               => true,
        'show_admin_column'     => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var'             => true,
        'rewrite'               => array( 'slug' => 'writer' ),
    );
 
    register_taxonomy( 'writer', 'book', $args );
}
// hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', 'wpdocs_create_book_taxonomies', 0 );

*/



/* Uncomment to register a slider Custom Post Type for easy brandtile integration
function register_slides_init() {
 
  $labels = array(
    'name' => _x('Slides', 'post type general name', 'your_text_domain'),
    'singular_name' => _x('Slide', 'post type singular name', 'your_text_domain'),
    'add_new' => _x('Add New', 'slide', 'your_text_domain'),
    'add_new_item' => __('Add New Slide', 'your_text_domain'),
    'edit_item' => __('Edit Slide', 'your_text_domain'),
    'new_item' => __('New Slide', 'your_text_domain'),
    'all_items' => __('All Slides', 'your_text_domain'),
    'view_item' => __('View Slide', 'your_text_domain'),
    'search_items' => __('Search Slides', 'your_text_domain'),
    'not_found' =>  __('No slides found', 'your_text_domain'),
    'not_found_in_trash' => __('No slides found in Trash', 'your_text_domain'), 
    'parent_item_colon' => '',
    'menu_name' => __('Slider', 'your_text_domain')

  );
  
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'show_in_menu' => true, 
    'query_var' => true,
    'rewrite' => array( 'slug' => _x( 'slide', 'URL slug', 'your_text_domain' ) ),
    'capability_type' => 'post',
    'has_archive' => false, 
    'hierarchical' => true,
    'menu_position' => null,
    'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
  ); 
  
  register_post_type('slide', $args);
}
add_action( 'init', 'register_slides_init' );

//add filter to change the system messages for the post type
function slide_updated_messages( $messages ) {
  global $post, $post_ID;

  $messages['slide'] = array(
    0 => '', // Unused. Messages start at index 1.
    1 => sprintf( __('Slide updated. <a href="%s">View slide</a>', 'your_text_domain'), esc_url( get_permalink($post_ID) ) ),
    2 => __('Custom field updated.', 'your_text_domain'),
    3 => __('Custom field deleted.', 'your_text_domain'),
    4 => __('Slide updated.', 'your_text_domain'),
    // translators: %s: date and time of the revision
    5 => isset($_GET['revision']) ? sprintf( __('Slide restored to revision from %s', 'your_text_domain'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
    6 => sprintf( __('Slide published. <a href="%s">View slide</a>', 'your_text_domain'), esc_url( get_permalink($post_ID) ) ),
    7 => __('Slide saved.', 'your_text_domain'),
    8 => sprintf( __('Slide submitted. <a target="_blank" href="%s">Preview slide</a>', 'your_text_domain'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    9 => sprintf( __('Slide scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview slide</a>', 'your_text_domain'),
      // translators: Publish box date format, see http://php.net/date
      date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
    10 => sprintf( __('Slide draft updated. <a target="_blank" href="%s">Preview slide</a>', 'your_text_domain'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
  );

  return $messages;
}
add_filter( 'post_updated_messages', 'slide_updated_messages' );
*/

/* Uncomment to register the testimonial Custom Post Type

function register_testimonial_init() {
 
  $labels = array(
    'name' => _x('Testimonials', 'post type general name'),
    'singular_name' => _x('Testimonial', 'post type singular name'),
    'add_new' => _x('Add New', 'testimonial'),
    'add_new_item' => __('Add New Testimonial'),
    'edit_item' => __('Edit Testimonial'),
    'new_item' => __('New Testimonial'),
    'all_items' => __('All Testimonials'),
    'view_item' => __('View Testimonial'),
    'search_items' => __('Search Testimonials'),
    'not_found' =>  __('No testimonials found'),
    'not_found_in_trash' => __('No testimonials found in Trash'), 
    'parent_item_colon' => '',
    'menu_name' => __('Testimonials')

  );
  
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'show_in_menu' => true, 
	'menu_icon' => get_bloginfo('template_url').'/images/cpt/testimonial.png',
    'query_var' => true,
    'rewrite' => array( 'slug' => _x( 'testimonials', 'URL slug' ) ),
    'capability_type' => 'page',
    'has_archive' => true, 
    'hierarchical' => true,
    'menu_position' => null,
    'supports' => array( 'title', 'editor', 'thumbnail' )
  ); 
  
  register_post_type('testimonial', $args);
}
add_action( 'init', 'register_testimonial_init' );

//add filter to change the system messages for the post type
function testimonial_updated_messages( $messages ) {
  global $post, $post_ID;

  $messages['testimonial'] = array(
    0 => '', // Unused. Messages start at index 1.
    1 => sprintf( __('Testimonial updated. <a href="%s">View testimonial</a>'), esc_url( get_permalink($post_ID) ) ),
    2 => __('Custom field updated.'),
    3 => __('Custom field deleted.'),
    4 => __('Testimonial updated.'),
    // translators: %s: date and time of the revision
    5 => isset($_GET['revision']) ? sprintf( __('Testimonial restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
    6 => sprintf( __('Testimonial published. <a href="%s">View testimonial</a>'), esc_url( get_permalink($post_ID) ) ),
    7 => __('Testimonial saved.'),
    8 => sprintf( __('Testimonial submitted. <a target="_blank" href="%s">Preview testimonial</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    9 => sprintf( __('Testimonial scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview testimonial</a>'),
      // translators: Publish box date format, see http://php.net/date
      date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
    10 => sprintf( __('Testimonial draft updated. <a target="_blank" href="%s">Preview testimonial</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
  );

  return $messages;
}

add_filter( 'post_updated_messages', 'testimonial_updated_messages' );
*/
/*-----------------------------------------------------------------------------------*/

/* create custom post => portfolio

/*-----------------------------------------------------------------------------------*/

function create_portfolio()

{

    $portfolio_args = array(

        'label' => __('Portfolio', 'framework'),

        'singular_label' => __('Portfolio', 'framework'),

        'public' => true,

        'show_ui' => true,

        'capability_type' => 'post',

        'hierarchical' => false,

        'rewrite' => true,

        'supports' => array('title', 'editor', 'excerpt'));

    register_post_type('portfolio', $portfolio_args);

}



add_action('init', 'create_portfolio');



// create custom portfolio tags taxonomy

function create_portfolio_tags()

{

    $labels = array(

        'name' => _x('Categories', 'taxonomy general name'),

        'singular_name' => _x('Categories', 'taxonomy singular name'),

        'search_items' => __('Search Portfolio Categories', 'framework'),

        'all_items' => __('All Locations', 'framework'),

        'parent_item' => __('Parent Location', 'framework'),

        'parent_item_colon' => __('Parent Location:', 'framework'),

        'edit_item' => __('Edit Category', 'framework'),

        'update_item' => __('Update Category', 'framework'),

        'add_new_item' => __('Add New Category', 'framework'),

        'new_item_name' => __('New Category Name', 'framework'),

    );



    register_taxonomy(

        'port-cat',

        'portfolio',

        array('hierarchical' => true,

            'labels' => $labels,

        ));



}



add_action('init', 'create_portfolio_tags');
?>