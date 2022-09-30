<?php



/*-----------------------------------------------------------------------------------*/

/*	Load Translation Text Domain

/*-----------------------------------------------------------------------------------*/



load_theme_textdomain('framework');


/*-----------------------------------------------------------------------------------*/

/*	register WP3.0+ menus

/*-----------------------------------------------------------------------------------*/

function register_menu()

{

    register_nav_menu('primary-menu', __('Main Menu', 'framework'));

}



add_action('init', 'register_menu');



/*-----------------------------------------------------------------------------------*/

/*	search only posts

/*-----------------------------------------------------------------------------------*/

function search_only_posts($query)

{

    if ($query->is_search) {

        $query->set('post_type', 'post');

    }

    return $query;

}



add_filter('pre_get_posts', 'search_only_posts');





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



// add tag classes to the post_class

function add_post_classes($classes)

{

    global $post;

    $terms = wp_get_object_terms($post->ID, 'port-cat');

    foreach ($terms as $tag) {

        $classes[] = 'tag-' . $tag->slug;

    }

    return $classes;

}



add_filter('post_class', 'add_post_classes');

/*-----------------------------------------------------------------------------------*/

/* Add portfolio Columns

/*-----------------------------------------------------------------------------------*/



function add_new_portfolio_columns($gallery_columns)

{

    $new_columns['cb'] = '<input type="checkbox" />';

    $new_columns['title'] = "Title";

    $new_columns['categories1'] = 'Categories';

    $new_columns['date'] = _x('Date', 'column name');



    return $new_columns;

}



add_filter('manage_edit-portfolio_columns', 'add_new_portfolio_columns');



function col_port_cat_column($column, $post_id)

{

    global $post;



    switch ($column) {

        /* If displaying the 'genre' column. */

        case 'categories1' :



            /* Get the genres for the post. */

            $terms = get_the_terms($post_id, 'port-cat');



            /* If terms were found. */

            if (!empty($terms)) {



                $out = array();



                /* Loop through each term, linking to the 'edit posts' page for the specific term. */

                foreach ($terms as $term) {

                    $out[] = sprintf('<a href="%s">%s</a>',

                        esc_url(add_query_arg(array('post_type' => $post->post_type, 'port-cat' => $term->slug), 'edit.php')),

                        esc_html(sanitize_term_field('name', $term->name, $term->term_id, 'port-cat', 'display'))

                    );

                }



                /* Join the terms, separating them with a comma. */

                echo join(', ', $out);

            } /* If no terms were found, output a default message. */

            else {

                _e('No Genres', 'framework');

            }



            break;



        /* Just break out of the switch statement for everything else. */

        default :

            break;

    }

}



add_action('manage_portfolio_posts_custom_column', 'col_port_cat_column', 10, 2);





/*-----------------------------------------------------------------------------------*/

/* enable post formats

/*-----------------------------------------------------------------------------------*/

$formats = array(

    'gallery',

    'video'

);



add_theme_support('post-formats', $formats);

add_post_type_support('post', 'post-formats');



/*-----------------------------------------------------------------------------------*/

/*	Configure WP2.9+ Thumbnails

/*-----------------------------------------------------------------------------------*/

if (function_exists('add_theme_support')) {

    add_theme_support('post-thumbnails');

    //set_post_thumbnail_size(336, 188, true); // default Post Thumbnail dimensions

}



if (function_exists('add_image_size')) {

    add_image_size('thumbnail-large', 745, 9999, false); // for blog pages

//    add_image_size('slider-large', 960, 9999, false); // for blog pages

}





/*-----------------------------------------------------------------------------------*/

/*	Change Default Excerpt Length

/*-----------------------------------------------------------------------------------*/



function col_excerpt_length($length)

{

    return 17;

}



add_filter('excerpt_length', 'col_excerpt_length');



/*-----------------------------------------------------------------------------------*/

/*	Configure Excerpt String

/*-----------------------------------------------------------------------------------*/

if (!function_exists('ck_excerpt_more')) {

    function ck_excerpt_more($excerpt)

    {

        return str_replace('[...]', '', $excerpt);

    }



    add_filter('wp_trim_excerpt', 'ck_excerpt_more');



}



/*-----------------------------------------------------------------------------------*/

/* enable sidebars

/*-----------------------------------------------------------------------------------*/



if (function_exists('register_sidebar')) {

    register_sidebar(array(

        'name' => 'Main Sidebar',

        'before_widget' => '<div id="%1$s" class="widget %2$s">',

        'after_widget' => '</div>',

        'before_title' => '<h3 class="widget-title"><span>',

        'after_title' => '</span></h3>',

    ));

}



/*-----------------------------------------------------------------------------------*/

/* Extra

/*-----------------------------------------------------------------------------------*/

add_theme_support('automatic-feed-links');

if ( ! isset( $content_width ) ) $content_width = 1140;

/*-----------------------------------------------------------------------------------*/

/* Embed javascripts

/*-----------------------------------------------------------------------------------*/

function my_scripts_method()

{

    // script

   // wp_deregister_script('jquery');

   // wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js', '', NULL, FALSE);

    // wp_register_script('slickNav', get_template_directory_uri() . '/js/jquery.slicknav.min.js', array('jquery'), NULL, FALSE);

    // wp_register_script('parallax', get_template_directory_uri() . '/js/parallax.js', array('jquery'), NULL, FALSE);

    // wp_register_script('jqueryui', get_template_directory_uri() . '/js/jquery-ui-1.8.22.custom.min.js', '', NULL, FALSE);

    // wp_register_script('superfish', get_template_directory_uri() . '/js/superfish.js', '', NULL, FALSE);

    // wp_register_script('supersubs', get_template_directory_uri() . '/js/supersubs.js', '', NULL, FALSE);

    // wp_register_script('validation', 'http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js', 'jquery');

    wp_register_script('commons', get_template_directory_uri() . '/js/common.js', array('jquery', 'slickNav'), NULL, FALSE);

//    wp_register_script('fittext', get_template_directory_uri() . '/js/jquery.fittext.js', '', NULL, FALSE);

    // wp_register_script('fitvids', get_template_directory_uri() . '/js/jquery.fitvids.js', '', NULL, FALSE);

//    wp_register_script('jplayer', get_template_directory_uri() . '/js/jquery.jplayer.min.js', '', NULL, FALSE);

    // wp_register_script('home', get_template_directory_uri() . '/js/home.js', '', NULL, FALSE);

    // wp_register_script('flexslider', get_template_directory_uri() . '/js/jquery.flexslider-min.js', '', NULL, FALSE);

//    wp_register_script('hoverintent', get_template_directory_uri() . '/js/jquery.hoverIntent.minified.js', '', NULL, FALSE);

    // wp_register_script('portfolio', get_template_directory_uri() . '/js/portfolio.js', '', NULL, FALSE);

    // wp_register_script('portfolioslider', get_template_directory_uri() . '/js/portfolio-slider.js', '', NULL, FALSE);

    // wp_register_script('touchwipe', get_template_directory_uri() . '/js/jquery.touchwipe.min.js', '', NULL, FALSE);

    // wp_register_script('mousewheel', get_template_directory_uri() . '/js/jquery.mousewheel.min.js', '', NULL, FALSE);

    // wp_register_script('portfolioSingle', get_template_directory_uri() . '/js/portfolio-single.js', '', NULL, FALSE);

    // wp_register_script('prettyphoto', get_template_directory_uri() . '/js/jquery.prettyPhoto.js', '', NULL, FALSE);

    // wp_register_script('blog', get_template_directory_uri() . '/js/blog.js', '', NULL, FALSE);

    // wp_register_script('blogSingle', get_template_directory_uri() . '/js/blog-single.js', '', NULL, FALSE);


    // style

    // wp_register_style('pp-style', get_template_directory_uri() . '/images/prettyPhoto/prettyPhoto.css');



    // wp_enqueue_script('jquery');

    // wp_enqueue_script('jqueryui');

    wp_enqueue_script('superfish');

    // wp_enqueue_script('supersubs');

//    wp_enqueue_script('hoverintent');

//    wp_enqueue_script('fittext');

    // wp_enqueue_script('fitvids');

    wp_enqueue_script('slickNav');

    wp_enqueue_script('commons');


    //script for the home

    if (is_page_template('template-home.php')) {

        wp_enqueue_script('flexslider');

        wp_enqueue_script('touchwipe');

        wp_enqueue_script('mousewheel');

        wp_enqueue_script('portfolioslider');

        wp_enqueue_script('home');

    }



    //script for the portfolio page

    if (is_page_template('template-portfolio.php')) {

        wp_enqueue_script('portfolio');

    }



    if (is_page_template('template-portfolio-slider.php')) {

        wp_enqueue_script('touchwipe');

        wp_enqueue_script('mousewheel');

        wp_enqueue_script('portfolioslider');

    }



    if (is_singular('portfolio')) {

//        wp_enqueue_script('jplayer');

        wp_enqueue_script('prettyphoto');

        wp_enqueue_style('pp-style');

        wp_enqueue_script('portfolioSingle');



    }





    //script for the blog pages

    if (is_page_template('template-blog.php') || !is_singular() && !is_404()) {

        wp_enqueue_script('blog');



    }

    if (is_singular('post')) {

        wp_enqueue_script('flexslider');

        wp_enqueue_script('blogSingle');

        wp_enqueue_script('comment-reply');

    }





    // load custom script which shows on the contact page.

    if (is_page_template('template-contact.php')) wp_enqueue_script('validation');





}



add_action('wp_enqueue_scripts', 'my_scripts_method');





if (!function_exists('ck_contact_validate')) {

    // load validation js for contact form template

    function ck_contact_validate()

    {

        if (is_page_template('template-contact.php')) {

            ?>

        <script type="text/javascript">

            jQuery(document).ready(function () {

                jQuery("#contactForm").validate({

                    errorPlacement:function (error, element) {

                        error.insertAfter(element.parent());

                    },

                    focusCleanup:true

                });

            });

        </script>

        <?php



        }

    }



    add_action('wp_head', 'ck_contact_validate');

}



/*-----------------------------------------------------------------------------------*/

// Other externalised functions

/*-----------------------------------------------------------------------------------*/

// Add additional helper functions

include("functions/utils.php");

// Add the post meta

include("functions/pagemeta.php");

// Add the portfolio meta

include("functions/portfoliometa.php");

// Add the post meta

include("functions/postmeta.php");





// Add the Latest Portfolio Posts Custom Widget

include("functions/widget-portfolio-posts.php");

// Add the Latest Portfolio Posts Custom Widget

include("functions/widget-portfolio-posts-title.php");



// Add the Twitter Custom Widget

include("functions/widget-tweets.php");





// Add the Theme Shortcodes

include("functions/shortcodes.php");

add_filter('widget_text', 'shortcode_unautop');

add_filter('widget_text', 'do_shortcode');



define('COL_FILEPATH', get_template_directory());

define('COL_DIRECTORY', get_template_directory_uri());

require_once (COL_FILEPATH . '/tinymce/tinymce.loader.php');

/*-----------------------------------------------------------------------------------*/

// Options Framework

/*-----------------------------------------------------------------------------------*/



// Paths to admin functions

define('ADMIN_PATH', get_template_directory() . '/admin/');

define('ADMIN_DIR', get_template_directory_uri() . '/admin/');

define('LAYOUT_PATH', get_template_directory() . '/css/');



// You can mess with these 2 if you wish.

//$themedata = get_theme_data(STYLESHEETPATH . '/style.css');

$themedata = wp_get_theme();

define('THEMENAME', $themedata->Name);

define('OPTIONS', 'of_options'); // Name of the database row where your options are stored

define('BACKUPS', 'of_backups'); // Name of the database row for options backup



// Build Options

require_once (ADMIN_PATH . 'admin-interface.php'); // Admin Interfaces

require_once (ADMIN_PATH . 'theme-options.php'); // Options panel settings and custom settings

require_once (ADMIN_PATH . 'admin-functions.php'); // Theme actions based on options settings

require_once (ADMIN_PATH . 'medialibrary-uploader.php'); // Media Library Uploader
