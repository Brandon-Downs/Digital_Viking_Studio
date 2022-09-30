<!DOCTYPE html>

<html <?php language_attributes(); ?>>

<head>

    <!-- Meta Tags -->

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1"/>

    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>"/>

    <!-- Title -->

    <title><?php bloginfo('name'); ?> <?php wp_title(); ?></title>



    <!-- 1140px Grid styles for IE -->

    <!--[if lte IE 9]>

    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/grid/ie.css" type="text/css"

          media="screen"/>

    <![endif]-->



    <!-- The 1140px Grid - http://cssgrid.net/ -->

    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/grid/1140.css" type="text/css"

          media="screen"/>





    <!-- Stylesheets -->

    <?php global $data; ?>

    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen"/>

    <link rel="stylesheet"

          href="<?php echo get_template_directory_uri(); ?>/css/<?php echo $data['iter_alt_stylesheet']?>"

          type="text/css" media="screen" id="site_skin">



    <!--css3-mediaqueries-js - http://code.google.com/p/css3-mediaqueries-js/ - Enables media queries in some unsupported browsers-->

    <script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/css3-mediaqueries.js"></script>

    <!-- <script src="js/parallax.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parallax/2.1.3/parallax.min.js"></script>



    <?php wp_head(); ?>



</head>



<body <?php body_class();?> >

<?php // Load our custom background image

// gain access to post id

global $wp_query;

if (is_home()) {

    $postid = get_option('page_for_posts');

} elseif (is_search() || is_404() || is_archive()) {

    $postid = get_option('page_for_posts');

} else {

    $postid = $wp_query->post->ID;

}



// Get the unique background image

$bg_img = get_post_meta($postid, 'coll_background_image', true);

if (empty($bg_img)) {

    // No image supplied, fall back to default values

    $bg_pos = $data['coll_default_bg_position'];



    // Check background position to see if we need to continue

    if ($bg_pos == 'full') {

        $bg_img = $data['coll_default_bg_image'];

        if (!empty($bg_img)) {

            $posttitle = $wp_query->post->post_title;



            // got the details, load the image

            echo '<img id="background" src="' . $bg_img . '" alt="' . $posttitle . '" />';

        }

    }

} else {

    // Unique background image included

    // Check background position to see if we need to continue

    $bg_pos = get_post_meta($postid, 'coll_background_position', true);



    if ($bg_pos == __('Full Screen', 'framework')) {

        $posttitle = $wp_query->post->post_title;



        // got the details, load the image

        echo '<img id="background" src="' . $bg_img . '" alt="' . $posttitle . '" />';

    }

}

?>

<!-- confetti-->

<?php if (empty($bg_img) && empty($data['coll_default_bg_image'])) { ?>

<div class="conf-container">

    <div class="conf"></div>

</div>

    <?php }    ?>

<div class="header clearfix">

    <div class="container">

        <div class="row">

            <div class="logo sixcol">

                <a href="<?php echo home_url(); ?>"> <img src="<?php echo $data['iter_site_logo']; ?>"></a>

            </div>

            <div class="social sixcol last">

                <ul>

                    <?php if ($data['iter_twitter_url']) { ?>

                    <li class="twitter"><a href="<?php echo $data['iter_twitter_url']; ?>" target="_blank"

                                           title="Twitter">

                        <?php _e('Twitter', 'framework'); ?>

                    </a></li>

                    <?php } ?>

                    <?php if ($data['iter_facebook_url']) { ?>

                    <li class="facebook"><a href="<?php echo $data['iter_facebook_url']; ?>" target="_blank"

                                            title="Facebook">

                        <?php _e('Facebook', 'framework'); ?>

                    </a></li>

                    <?php } ?>

                    <?php if ($data['iter_gplus_url']) { ?>

                    <li class="gplus"><a href="<?php echo $data['iter_gplus_url']; ?>" target="_blank"

                                         title="Google Plus">

                        <?php _e('Google+', 'framework'); ?>

                    </a></li>

                    <?php } ?>

                    <?php if ($data['iter_dribble_url']) { ?>

                    <li class="dribble"><a href="<?php echo $data['iter_dribble_url']; ?>" target="_blank"

                                           title="Dribbble">

                        <?php _e('Dribbble', 'framework'); ?>

                    </a></li>

                    <?php } ?>

                    <?php if ($data['iter_flickr_url']) { ?>

                    <li class="flickr"><a href="<?php echo $data['iter_flickr_url']; ?>" target="_blank" title="Flickr">

                        <?php _e('Flickr', 'framework'); ?>

                    </a></li>

                    <?php } ?>



                    <?php if ($data['iter_youtube_url']) { ?>

                    <li class="youtube"><a href="<?php echo $data['iter_youtube_url']; ?>" target="_blank"

                                           title="YouTube">

                        <?php _e('YouTube', 'framework'); ?>

                    </a></li>

                    <?php } ?>

                    <?php if ($data['iter_vimeo_url']) { ?>

                    <li class="vimeo"><a href="<?php echo $data['iter_vimeo_url']; ?>" target="_blank" title="Vimeo">

                        <?php _e('Vimeo', 'framework'); ?>

                    </a></li>

                    <?php } ?>

                    <?php if ($data['iter_linkedin_url']) { ?>

                    <li class="linkedin"><a href="<?php echo $data['iter_linkedin_url']; ?>" target="_blank"

                                            title="LinkedIn">

                        <?php _e('LinkedIn', 'framework'); ?>

                    </a></li>

                    <?php } ?>

                    <?php if ($data['iter_pinterest_url']) { ?>

                    <li class="pinterest"><a href="<?php echo $data['iter_pinterest_url']; ?>" target="_blank"

                                             title="Pinterest">

                        <?php _e('Pinterest', 'framework'); ?>

                    </a></li>

                    <?php } ?>

                </ul>

            </div>

        </div>

    </div>

    <div class="navigation container">

        <div class="row clearfix">

            <div class="twelvecol">

                <div id="mainmenu" class="mainmenu">

                    <?php

                    wp_nav_menu(array(

                        'theme_location' => 'primary-menu',

                        'container' => '',

                        'menu_class' => 'sf-menu sf-navbar', //Adding the class for dropdowns

                        'before' => '',

                        'fallback_cb' => ''



                    ));

                    ?>

                </div>

            </div>

        </div>

        <!--        <div class=" row shadow"></div>-->

    </div>

</div>





