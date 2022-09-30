<?php

################################################################################
//Include Files
################################################################################

//Custom Post Types
include('functions_cpt.php');

// Custom functions
// include('functions_custom.php');

//Images
include('functions_images.php');

//Navigation
include('functions_nav.php');

//Shortcodes
include('functions_shortcodes.php');

//Sidebars
include('functions_sidebars.php');

################################################################################
//Functions
################################################################################

function show_posts_nav() {
   global $wp_query;
   return ($wp_query->max_num_pages > 1);
}

//Add post thumbnails to RSS
function cwc_rss_post_thumbnail($content) {

    global $post;

    if(has_post_thumbnail($post->ID)) {
        $content = '<p>' . get_the_post_thumbnail($post->ID) . '</p>' . get_the_excerpt();
	}
    
	return $content;
}

add_filter('the_excerpt_rss', 'cwc_rss_post_thumbnail');

add_filter('the_content_feed', 'cwc_rss_post_thumbnail');

add_filter('acf/format_value/type=text', 'do_shortcode');

add_filter('acf/format_value/type=textarea', 'do_shortcode');

/*
**	ready_post: Get a single post or page by id and automatically set it up for use
**	Usage: 
**		$myPost = ready_post($id);
**		if($myPost){
**			if(has_post_thumbnail()){ the_post_thumbnail(); } 
**			the_title();
**			the_content('Read More');
**			...
**			wp_reset_postdata();
**			wp_reset_query();
**		}
*/

function ready_post($id){
	global $post;
	global $more;
	
	$post = get_post($id);
	
	if($post){
		setup_postdata($post);
		$more = 0;
	}
	
	return $post;
}

function dvs_scripts_and_styles() {
    
    wp_enqueue_style( 
        'dvs-theme-styles', 
        get_stylesheet_directory_uri() . '/style.css', 
        array(), 
        _dvs_theme_get_cache_version( 'style.css' )
    );    

    // custom jQuery - generally not recommended unless necessary
    // wp_dequeue_script( 'jquery' );
    // wp_enqueue_script(
    //     'jquery', 
    //     'https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js', 
    //     array(), 
    //     null, // Version - null means never cache
    //     false // In footer - Do NOT load jQuery in the footer. Things will break
    // );

    wp_enqueue_script(
        'dvs-theme-fontawesome', 
        'https://kit.fontawesome.com/5861d991c8.js', 
        array(), 
        null, //Version - null means never cache
        true //In footer
        //Use in theme example:
        //font-family: "FontAwesome";
    );

    // wp_enqueue_script(
    //     'parallax-scripts', 
    //     get_stylesheet_directory_uri() . '/js/src/vendor/parallax.js', 
    //     array( 'jquery' ),
    //     null,
    //     true
    // );

    wp_enqueue_script(
        'dvs-theme-scripts', 
        get_stylesheet_directory_uri() . '/js/build/loadScripts.min.js', 
        array( 'jquery' ),
        _dvs_theme_get_cache_version( 'loadScripts.min.js', '/js/build/' ),
        true
    );

}
add_action( 'wp_enqueue_scripts', 'dvs_scripts_and_styles' );

function dvs_theme_admin_scripts() {

    wp_enqueue_script(
        'dvs-theme-admin-scripts', 
        get_stylesheet_directory_uri() . '/js/build/admin.min.js', 
        array( 'jquery' ),
        null 
    );

}
add_action( 'admin_enqueue_scripts', 'dvs_theme_admin_scripts' );

function _dvs_theme_get_cache_version( $filename, $path_in_theme = '/' ) {

	$found = false;
	$cache_version = null;

	if ( (defined( 'WP_DEBUG' ) && WP_DEBUG === true) && !defined('ALWAYS_CACHE') ) {
		// always bust cache when WP_DEBUG is turned on 
		$cache_version = wp_cache_get( 'cache_version', 'dvs_theme', false, $found );

		if( false === $found ) {
			$cache_version = bin2hex(random_bytes(4));
			wp_cache_set( 'cache_version', $cache_version, 'dvs_theme' );
		}

	} else {
		$asset_manifest = wp_cache_get( 'asset_cache_manifest', 'dvs_theme', false, $found );

		if( false === $found ) {

			$asset_manifest = file_get_contents( get_template_directory() . '/asset_cache_manifest.json' );

			if ( false === $asset_manifest ) {
				error_log('warning: cache version is missing. run gulp to regenerate it.');

				$cache_version = filemtime( get_template_directory() . $path_in_theme . $filename );
			}

			// cache the asset manifest for this page load
			wp_cache_set( 'asset_cache_manifest', $asset_manifest, 'dvs_theme' );

		}

		$asset_manifest_json = json_decode( $asset_manifest );

		if( !empty( $asset_manifest_json->$filename ) )
			$cache_version = $asset_manifest_json->$filename;
        else 
            $cache_version = filemtime( get_template_directory() . $path_in_theme . $filename );

	}

	return $cache_version;
}

################################################################################
// Add theme support
################################################################################
add_theme_support( 'automatic-feed-links' );


################################################################################
// The Excerpt & The Content
################################################################################

//Page Excerpt Text
add_post_type_support( 'page', 'excerpt' );

//Custom Excerpt Text - Uncomment this function to change text or html inside the excerpt
/*
function custom_excerpt($text) {
	$text = str_replace('<p>', '<p class="excerpt">', $text);
	return $text;
}
add_filter('the_excerpt', 'custom_excerpt');
*/

//Custom Excerpt More - Use this function to change the ... that appears after the excerpt
function dvs_theme_new_excerpt_more( $more ) {
	return '&hellip;';
}
add_filter('excerpt_more', 'dvs_theme_new_excerpt_more');

//Custom Excerpt Length
function dvs_theme_new_excerpt_length($length) {
	return 50;  /* Or whatever you want the length to be. */
}
add_filter('excerpt_length', 'dvs_theme_new_excerpt_length');

################################################################################
// Comments
################################################################################

//Disables commenting on pages by default
function dvs_theme_default_comments_off( $data, $postarr ) {
     if( $data['post_type'] == 'page' ) {
          if( !($postarr['ID']) ){
               $data['comment_status'] = 0; //0 = false | 1 = true
          }
     }
     return $data;
}
add_filter( 'wp_insert_post_data', 'dvs_theme_default_comments_off', '', 2);

function remove_pages_count_columns($defaults) {
  unset($defaults['comments']);
  return $defaults;
}
add_filter('manage_pages_columns', 'remove_pages_count_columns');



//Theme the comments
function dvs_theme_theme_comments($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment; ?>
   	<li>
     <article <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
       <header class="comment-author vcard">
          <?php echo get_avatar($comment,$size='48',$default='' ); ?>
          <?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) ?>
          <time><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a></time>
          <?php edit_comment_link(__('(Edit)'),'  ','') ?>
       </header>
       <?php if ($comment->comment_approved == '0') : ?>
          <em><?php _e('Your comment is awaiting moderation.') ?></em>
          <br />
       <?php endif; ?>

       <?php comment_text() ?>

       <nav>
         <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
       </nav>
     </article>
    <!-- </li> is added by wordpress automatically -->
    <?php
}

################################################################################
// Actions
################################################################################

// Remove links to the extra feeds (e.g. category feeds)
remove_action( 'wp_head', 'feed_links_extra', 3 );

// Remove links to the general feeds (e.g. posts and comments)
remove_action( 'wp_head', 'feed_links', 2 );

// Remove link to the RSD service endpoint, EditURI link
remove_action( 'wp_head', 'rsd_link' );

// Remove link to the Windows Live Writer manifest file
remove_action( 'wp_head', 'wlwmanifest_link' );

// Remove index link
remove_action( 'wp_head', 'index_rel_link' );

// Remove prev link
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );

// Remove start link
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );

// Display relational links for adjacent posts
remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 );

// Remove XHTML generator showing WP version
remove_action( 'wp_head', 'wp_generator' );

// Disable login modals introduced in WordPress 3.6
remove_action( 'admin_enqueue_scripts', 'wp_auth_check_load' );


// Allow HTML in descriptions
// $filters = array('pre_term_description', 'pre_link_description', 'pre_link_notes', 'pre_user_description');
// foreach ( $filters as $filter ) {
// 	remove_filter($filter, 'wp_filter_kses');
// }

/**
 * Register and enqueue a custom stylesheet in the WordPress admin.
 */
function dvs_custom_admin_style() {
        wp_register_style( 'dvs_admin_css', get_template_directory_uri() . '/css/admin-style.css', false, '1.0.0' );
        wp_enqueue_style( 'dvs_admin_css' );

}
add_action( 'admin_enqueue_scripts', 'dvs_custom_admin_style' );


add_action('admin_head', 'dvs_theme_show_favicon');
function dvs_theme_show_favicon() {
    echo '<link href="'. get_stylesheet_directory_uri() .'/favicon.ico" rel="icon" type="image/x-icon">';
}

add_filter( 'random_password', 'dvs_random_password' );
function dvs_random_password($password) {
    global $post;
    if(!empty($post)) {
        $action = get_post_meta($post->ID, '_tml_action', true);
        if($action === 'resetpass' && strlen($password) < 20) {
            $password = wp_generate_password(20);
        }
    }
    
    return $password;
}

add_filter( 'auth_cookie_expiration', 'keep_me_logged_in_for_1_year' );
function keep_me_logged_in_for_1_year( $expirein ) {
    return YEAR_IN_SECONDS; // 1 year in seconds
}

function dvs_theme_svgz_mime_types( $mimes ) {
        
        // New allowed mime types.
        
        // $mimes['svg']  = 'image/svg+xml';
        //$mimes['svgz'] = 'image/svg+xml';
        //$mimes['svgz'] = 'application/x-gzip';        
        $mimes['doc']  = 'application/msword'; 
        $mimes['xls']  = 'application/vnd.ms-excel'; 
        $mimes['xlsx']  = 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'; 
     
        // Optional. Remove a mime type.
        unset( $mimes['exe'] );

        return $mimes;


}
add_filter( 'upload_mimes', 'dvs_theme_svgz_mime_types' );

if( function_exists('acf_add_options_page') ) {

    acf_add_options_page(); //optional if ACF "Options page" is not needed
	
    acf_add_options_page(array(
        'page_title' 	=> 'Admin Settings',
        'menu_title'	=> 'Admin Settings',
        'menu_slug' 	=> 'admin-settings',
        'capability'	=> 'manage_options',
        'redirect'		=> false
    ));

    /**
     * Output the contents of the dashboard widget
     */
    function dashboard_widget_function( $post, $callback_args ) {
        get_template_part( 'dashboard', 'message' );
        //esc_html_e( "Hello World, this is my first Dashboard Widget!", "textdomain" );
    }

    /**
     * Add a new dashboard widget.
     */
    function wpdocs_add_dashboard_widgets() {

        if( empty( get_field( 'dvs_admin_notes', 'option' ) ) ) return;

        wp_add_dashboard_widget( 'dvs_dashboard_widget', 'DVS Theme', 'dashboard_widget_function' );


    }
    add_action( 'wp_dashboard_setup', 'wpdocs_add_dashboard_widgets' );

}

function dvs_theme_strip_html_comments( string $html ) : string {
    return preg_replace( '/<!--(.*)-->/Uis', '', $html );
}