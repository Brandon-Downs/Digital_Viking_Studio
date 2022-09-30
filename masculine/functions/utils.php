<?php


/*-----------------------------------------------------------------------------------*/
/* BACKGROUNDS
/*-----------------------------------------------------------------------------------*/
if (!function_exists('coll_background_css')) {
    function coll_background_css()
    {
        global $data;
        $output = '';

        /* Set Custom Background Image if needed --------*/

        // gain access to post id
        global $wp_query;
        if (is_home()) {
            $postid = get_option('page_for_posts');
        } elseif (is_search() || is_404() || is_archive()) {
            $postid = get_option('page_for_posts');
        } else {
            $postid = $wp_query->post->ID;
        }


        // get custom image for page
        $bg_img = get_post_meta($postid, 'coll_background_image', true);

        if (empty($bg_img)) {
            // No custom image supplied, check the default position
            $bg_pos = $data['coll_default_bg_position'];

            if ($bg_pos != 'full') {
                // We aren't dealing with a full screen image, so set up body bg
                $bg_img = $data['coll_default_bg_image'];
                if (!empty($bg_img)) {
                    $bg_img = " url($bg_img)";
                } else {
                    $bg_img = " none";
                }
                $bg_repeat = $data['coll_default_bg_repeat'];
                $bg_color = get_post_meta($postid, 'coll_background_color', true);
                if (empty($bg_color)) {
                    $bg_color = $data['coll_default_bg_color'];
                }

                $output .= "body { \n\tbackground-color: $bg_color;\n\tbackground-image: $bg_img;\n\tbackground-attachment: fixed;\n\tbackground-repeat: $bg_repeat;\n\tbackground-position: top $bg_pos; \n}\n";
            }
            else{
                $bg_color = get_post_meta($postid, 'coll_background_color', true);
                if (empty($bg_color)) {
                    $bg_color = $data['coll_default_bg_color'];
                }
                $output .= "body { \n\tbackground-color: $bg_color; \n}\n";
            }
        } else {
            // Custom image provided, check default position
            $bg_pos = get_post_meta($postid, 'coll_background_position', true);

            if ($bg_pos != __('Full Screen', 'framework')) {
                // We aren't dealing with a full screen image, so set up body bg
                $bg_img = " url($bg_img)";

                // Handle the pos
                if ($bg_pos == __('Centered', 'framework')) {
                    $bg_pos = 'center';
                }
                $bg_pos = strtolower($bg_pos);

                // Handle the repeat
                $bg_repeat = get_post_meta($postid, 'coll_background_repeat', true);
                if ($bg_repeat == __('No Repeat', 'framework')) {
                    $bg_repeat = 'no-repeat';
                } elseif ($bg_repeat == __('Repeat', 'framework')) {
                    $bg_repeat = 'repeat';
                } elseif ($bg_repeat == __('Repeat Horizontally', 'framework')) {
                    $bg_repeat = 'repeat-x';
                } else {
                    $bg_repeat = 'repeat-y';
                }

                $bg_color = get_post_meta($postid, 'coll_background_color', true);
                if (empty($bg_color)) {
                    $bg_color = $data['coll_default_bg_color'];
                }

                $output .= "body { \n\tbackground-color: $bg_color;\n\tbackground-image: $bg_img;\n\tbackground-attachment: fixed;\n\tbackground-repeat: $bg_repeat;\n\tbackground-position: top $bg_pos; \n}\n";


            }
            else{
                $bg_color = get_post_meta($postid, 'coll_background_color', true);
                if (empty($bg_color)) {
                    $bg_color = $data['coll_default_bg_color'];
                }
                $output .= "body { \n\tbackground-color: $bg_color; \n}\n";
            }
        }

        /* Output our custom styles --------------------------*/
        if ($output <> '') {
            $output = "<!-- Custom Styling -->\n<style type=\"text/css\">\n" . $output . "</style>\n";
            echo stripslashes($output);
        }

    }

    add_action('wp_head', 'coll_background_css');
}

/*-----------------------------------------------------------------------------------*/
/* TITLE FONT SIZE
/*-----------------------------------------------------------------------------------*/
if (!function_exists('coll_title_font_size_css')) {
    function coll_title_font_size_css()
    {
        $output = '';

        // gain access to post id
        global $wp_query;

        if (is_home()) {
            $postid = get_option('page_for_posts');
        } elseif (is_search() || is_404() || is_archive()) {
            $postid = get_option('page_for_posts');
        } else {
            $postid = $wp_query->post->ID;
        }


        $fsize = get_post_meta($postid, 'coll_title_font_size', true);

        if (!empty($fsize)) {
            $output .= "div.container.title .row .text { \n\tfont-size: $fsize" . "px ;\n\tletter-spacing: 0 ;\n}\n";
        }


        /* Output our custom styles --------------------------*/
        if ($output <> '') {
            $output = "<!-- Custom Styling Title Font -->\n<style type=\"text/css\">\n" . $output . "</style>\n";
            echo stripslashes($output);
        }

    }

    add_action('wp_head', 'coll_title_font_size_css');
}


/*-----------------------------------------------------------------------------------*/
/* REMOVE LINKS FROM IMAGES IN ENTRY CONTENT
/*-----------------------------------------------------------------------------------*/

add_filter( 'the_content', 'attachment_image_link_remove_filter' );

function attachment_image_link_remove_filter( $content ) {
    $content =
        preg_replace(
            array('{<a(.*?)(wp-att|wp-content\/uploads)[^>]*><img}',
                '{ wp-image-[0-9]*" /></a>}'),
            array('<img','" />'),
            $content
        );
    return $content;
}

/*-----------------------------------------------------------------------------------*/
/* Add Favicon
/*-----------------------------------------------------------------------------------*/

if (!function_exists('col_favicon')) {
    function col_favicon()
    {
        global $data;
        if ($data['iter_custom_favicon'] != '') {
            echo '<link rel="shortcut icon" href="' . $data['iter_custom_favicon'] . '"/>' . "\n";
        } else {
            ?>
        <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri() ?>/admin/images/favicon.ico"/>
        <?php

        }
    }

    add_action('wp_head', 'col_favicon');
}


/*-----------------------------------------------------------------------------------*/
/* Show analytics code in footer */
/*-----------------------------------------------------------------------------------*/

if (!function_exists('col_analytics')) {
    function col_analytics()
    {
        global $data;
        $output = $data['iter_analytics'];
        if ($output <> "")
            echo stripslashes($output) . "\n";
    }

    add_action('wp_footer', 'col_analytics');
}

/*-----------------------------------------------------------------------------------*/
/* get a portfolio item content items
/*-----------------------------------------------------------------------------------*/
function get_port_item_content($post_id)
{
    global $wpdb;
    $query = "SELECT * FROM $wpdb->postmeta WHERE post_id = '$post_id' AND meta_key LIKE 'content-item%'";
    $content = $wpdb->get_results($query);
    sort($content);

    // go through each item of the $content array
    $n = 0;

    $data = array();

    foreach ($content as $content_item) {
        // get meta
        //$meta_value =;
        // add to array
        $data[] = json_decode($content_item->meta_value);

        $n++;
    }

    return $data;
}

// end of get_port_item_content
/*-----------------------------------------------------------------------------------*/
/*	Get related posts by taxonomy
/*-----------------------------------------------------------------------------------*/

if (!function_exists('get_posts_related_by_taxonomy')) {
    function get_posts_related_by_taxonomy($post_id, $taxonomy, $args = array())
    {
        $query = new WP_Query();
        $terms = wp_get_object_terms($post_id, $taxonomy);
        if (count($terms)) {
            // Assumes only one term per post in this taxonomy
            $post_ids = get_objects_in_term($terms[0]->term_id, $taxonomy);
            $post = get_post($post_id);
            $args = wp_parse_args($args, array(
                'post_type' => $post->post_type, // The assumes the post types match
                'post__not_in' => array($post_id),
                'taxonomy' => $taxonomy,
                'term' => $terms[0]->slug,
                'orderby' => 'rand',
                'posts_per_page' => 4
            ));
            $query = new WP_Query($args);
        }

        return $query;
    }
}


/*-----------------------------------------------------------------------------------*/
/*	Blog captions
/*-----------------------------------------------------------------------------------*/
function insert_blog_caption($aut, $nr)
{
    if ($nr > 0) {
        if (is_archive()) {
            if (is_category()) printf(__('All posts in %s', 'framework'), single_cat_title('', false));
            if (is_tag()) printf(__('All posts tagged %s', 'framework'), single_tag_title('', false));
            if (is_day()) {
                _e('Archive for ', 'framework');
                the_time('F jS, Y');
            }
            if (is_month()) {
                _e('Archive for ', 'framework');
                the_time('F, Y');
            }
            if (is_year()) {
                _e('Archive for ', 'framework');
                the_time('Y');
            }
            if (is_author()) {
                _e('All posts by ', 'framework');
                echo $aut->display_name;
            }
        } elseif (is_search()) {
            printf(__('Results for %s', 'framework'), '<span>' . $_GET['s'] . '<span>');
        } else {

        }
    } else {
        if (is_category()) { // If this is a category archive
            printf(__('Sorry, but there aren\'t any posts in the %s category yet.', 'framework'), single_cat_title('', false));
        } elseif (is_tag()) { // If this is a tag archive
            printf(__('Sorry, but there aren\'t any posts tagged %s yet.', 'framework'), single_tag_title('', false));
        } elseif (is_date()) { // If this is a date archive
            echo(__('Sorry, but there aren\'t any posts with this date.', 'framework'));
        } elseif (is_author()) { // If this is a category archive
            $userdata = get_userdatabylogin(get_query_var('author_name'));
            printf(__('Sorry, but there aren\'t any posts by %s yet.', 'framework'), $aut->display_name);
        } else {
            echo(__('No posts found.', 'framework'));
        }
    }


}

/*-----------------------------------------------------------------------------------*/
/*	Video JS
/*-----------------------------------------------------------------------------------*/
function insert_preloader()
{
    global $data;
    $s = substr($data['coll_alt_stylesheet'], 0, -4);
    ?>
<img src="<?php echo get_template_directory_uri() . "/images/ajax-loader.gif" ?>"/>
<?php

}

/*-----------------------------------------------------------------------------------*/
/*	Video JS
/*-----------------------------------------------------------------------------------*/
function insert_video($id, $w, $h, $t, $m, $o)
{
    ?>
<script type="text/javascript">
    $(document).ready(function () {
        if ($().jPlayer) {
            $("#jquery_jplayer_<?php echo $id; ?>").jPlayer({
                ready:function () {
                    $(this).jPlayer("setMedia", {
                        <?php if ($m != '') : ?>
                            m4v:"<?php echo $m; ?>",
                            <?php endif; ?>
                        <?php if ($o != '') : ?>
                            ogv:"<?php echo $o; ?>",
                            <?php endif; ?>
                        <?php if ($t != '') : ?>
                            poster:"<?php echo $t; ?>"
                            <?php endif; ?>
                    });
                },
                size:{
                    width:"<?php echo $w; ?>",
                    height:"<?php echo $h; ?>"
                },
                swfPath:"<?php echo get_template_directory_uri(); ?>/js",
                cssSelectorAncestor:"#jp_interface_<?php echo $id; ?>",
                supplied:"<?php if ($m != '') : ?>m4v, <?php endif; ?><?php if ($o != '') : ?>ogv, <?php endif; ?> all"
            });

        }
    });
</script>
<?php

}

/*-----------------------------------------------------------------------------------*/
/*	Audio JS
/*-----------------------------------------------------------------------------------*/
function insert_audio($id, $m, $o)
{
    ?>
<script type="text/javascript">
    $(document).ready(function () {
        if ($().jPlayer) {
            $("#jquery_jplayer_<?php echo $id; ?>").jPlayer({
                ready:function () {
                    $(this).jPlayer("setMedia", {
                        <?php if ($m != '') : ?>
                            mp3:"<?php echo $m; ?>",
                            <?php endif; ?>
                        <?php if ($o != '') : ?>
                            ogg:"<?php echo $o; ?>",
                            <?php endif; ?>
                    });
                },
                swfPath:"<?php echo get_template_directory_uri(); ?>/js",
                cssSelectorAncestor:"#jp_interface_<?php echo $id; ?>",
                supplied:"<?php if ($m != '') : ?>mp3, <?php endif; ?><?php if ($o != '') : ?>ogg, <?php endif; ?> all"
            });
        }
    });
</script>
<?php

}

/*-----------------------------------------------------------------------------------*/
/*	Comment Styling
/*-----------------------------------------------------------------------------------*/

if (!function_exists('iter_comment')) {
    function iter_comment($comment, $args, $depth)
    {

        $GLOBALS['comment'] = $comment; ?>
        <li <?php comment_class(); ?> >
            <div id="comment-<?php comment_ID(); ?>">
                <div class="comment-meta clearfix">
                    <ul class="extra">
                        <li>
                            <label class="name"><?php comment_author_link(); ?></label>
                        </li>
                        <li>
                            <small><?php comment_date(); ?> </small>
                        </li>
                        <li>
                            <small><?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?></small>
                        </li>
                        <li>
                            <small><?php edit_comment_link(__('(Edit)', 'framework'), '<small>', '</small>') ?></small>
                        </li>
                    </ul>
                </div>
                <div class="comment-body ">
                    <?php if ($comment->comment_approved == '0') : ?>
                    <em class="moderation"><?php _e('Your comment is awaiting moderation.', 'framework') ?></em>
                    <br/>
                    <?php endif; ?>
                    <?php comment_text() ?>
                </div>
            </div>

        <?php

    }
}
add_filter('next_posts_link_attributes', 'posts_link_attributes');
add_filter('previous_posts_link_attributes', 'posts_link_attributes');
add_filter('next_comments_link_attributes', 'posts_link_attributes');
add_filter('previous_comments_link_attributes', 'posts_link_attributes');

function posts_link_attributes()
{
    return 'class="superlink"';
}

/*-----------------------------------------------------------------------------------*/
/*	Seperated Pings Styling
/*-----------------------------------------------------------------------------------*/

if (!function_exists('col_pings')) {
    function col_pings($comment, $args, $depth)
    {
        $GLOBALS['comment'] = $comment; ?>
    <li class="ping comment-<?php comment_ID(); ?>"><?php comment_author_link(); ?>
        <?php

    }
}


/*-----------------------------------------------------------------------------------*/
/*	Add Custom Social Share Buttons
/*-----------------------------------------------------------------------------------*/
function custom_social_share()
{
    ?>
    <ul class="entry-social">
        <li class="facebook"><a target="_blank"
                                href="http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&t=<?php the_title(); ?>"><span
            class="social-icon"></span></a>
        </li>
        <li class="gplus"><a href="https://plusone.google.com/_/+1/confirm?hl=en&url=<?php the_permalink();?>"><span
            class="social-icon"></span></a></li>

        <li class="twitter">
            <a target="_blank"
               href="http://twitter.com/share?url=<?php the_permalink(); ?>&amp;text=Currently reading <?php the_title(); ?>"><span
                class="social-icon"></span></a>
        </li>
        <li class="pinit"><a
            href="javascript:void((function(){var e=document.createElement('script'); e.setAttribute('type','text/javascript'); e.setAttribute('charset','UTF-8'); e.setAttribute('src','http://assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);document.body.appendChild(e)})());">
            <span class="social-icon"></span></a></li>
    </ul>

<?php
}

/*-----------------------------------------------------------------------------------*/
/*	Add Custom Social Share Buttons
/*-----------------------------------------------------------------------------------*/
function ck_the_content($id = NULL)
{
    if (!$id) {
        global $post;
        $id = $post->ID;
    }

    echo ck_get_the_content($id);
}

function ck_get_the_content($id = NULL)
{
    if (!$id) {
        global $post;
        $id = $post->ID;
    }

    $post_data = get_post($id);
    $the_content = str_replace(']]>', ']]&gt>', apply_filters('the_content', $post_data->post_content));

    return $the_content;
}

/** Add custom body class to the head */
add_filter('body_class', 'add_body_class');
function add_body_class($classes)
{
    if (is_home() || is_search() || is_archive() || is_page_template('template-blog.php')) {
        $classes[] = 'post-list';
    }
    return $classes;
}

/*-----------------------------------------------------------------------------------*/
/*	CUSTOM COMMENT FORM
/*-----------------------------------------------------------------------------------*/
add_filter('comment_form_defaults', 'coll_comment_form');

function coll_comment_form($form_options)
{
    global $post_id, $user_identity;
    $commenter = wp_get_current_commenter();
    $req = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );

    // Fields Array
    $fields = array(

        'author' =>
        '<p class="comment-form-author">' .
//            ($req ? '<span class="required">*</span>' : '') .
            '<input id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" size="30"' . $aria_req . ' placeholder="' . __('Name') . '" />' .
            '</p>',

        'email' =>
        '<p class="comment-form-email">' .
//            ($req ? '<span class="required">*</span>' : '') .
            '<input id="email" name="email" type="text" value="' . esc_attr($commenter['comment_author_email']) . '" size="30"' . $aria_req . ' placeholder="' . __('Email') . '" />' .
            '</p>',

        'url' =>
        '<p class="comment-form-url">' .
            '<input name="url" size="30" id="url" value="' . esc_attr($commenter['comment_author_url']) . '" type="text" placeholder="' . __('Website') . '" />' .
            '</p>',

    );

    // Form Options Array
    $form_options = array(
        // Include Fields Array
        'fields' => apply_filters('comment_form_default_fields', $fields),

        // Template Options
        'comment_field' =>
        '<p class="comment-form-comment">' .
            '<textarea name="comment" id="comment" aria-required="true" rows="8" cols="45" placeholder="' . _x('Comment', 'noun') . '"></textarea>' .
            '</p>',

        'must_log_in' =>
        '<p class="must-log-in">' .
            sprintf(__('You must be <a href="%s">logged in</a> to post a comment.'),
                wp_login_url(apply_filters('the_permalink', get_permalink($post_id)))) .
            '</p>',

        'logged_in_as' =>
        '<p class="logged-in-as">' .
            sprintf(__('Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>'),
                admin_url('profile.php'), $user_identity, wp_logout_url(apply_filters('the_permalink', get_permalink($post_id)))) .
            '</p>',

        'comment_notes_before' => '',

        'comment_notes_after' => '',

        // Rest of Options
        'id_form' => 'commentForm',
        'id_submit' => 'comment-submit',
        'title_reply' => __('Add a comment', 'framework'),
        'title_reply_to' => __('Leave a Reply to %s', 'framework'),
        'cancel_reply_link' => __('| Cancel', 'framework'),
        'label_submit' => __('Submit Comment', 'framework'),
    );

    return $form_options;
}

/** first word  */

function coll_first_word($otitle)
{
    $output = '';


	$space_pos = strpos($otitle,' ');
	$before = '<span class="first-word">';
	$after = '</span>';

	if($space_pos)
    {
        $title = $before.$otitle;
        $output = substr_replace($title,$after.' ',$space_pos+strlen($before),1);
    }

    else $output = $before.$otitle.$after;

    return $output;
}