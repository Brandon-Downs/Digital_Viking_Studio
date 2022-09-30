<?php

add_action('init', 'of_options');

if (!function_exists('of_options')) {
    function of_options()
    {
        $shortname = "iter";

        //Access the WordPress Categories via an Array
        $of_categories = array();
        $of_categories_obj = get_categories('hide_empty=0');
        foreach ($of_categories_obj as $of_cat) {
            $of_categories[$of_cat->cat_ID] = $of_cat->cat_name;
        }
        $categories_tmp = array_unshift($of_categories, "Select a category:");

        //Access the WordPress Pages via an Array
        $of_pages = array();
        $of_pages_obj = get_pages('sort_column=post_parent,menu_order');
        foreach ($of_pages_obj as $of_page) {
            $of_pages[$of_page->ID] = $of_page->post_title;
        }
        $of_pages_tmp = array_unshift($of_pages, "Select a page:");

        //Testing
        $of_options_select = array("one", "two", "three", "four", "five");
        $of_options_radio = array("one" => "One", "two" => "Two", "three" => "Three", "four" => "Four", "five" => "Five");
        $of_options_homepage_blocks = array(
            "disabled" => array(
                "placebo" => "placebo", //REQUIRED!
                "block_one" => "Block One",
                "block_two" => "Block Two",
                "block_three" => "Block Three",
            ),
            "enabled" => array(
                "placebo" => "placebo", //REQUIRED!
                "block_four" => "Block Four",
            ),
        );


        //Stylesheets Reader
        $alt_stylesheet_path = LAYOUT_PATH;
        $alt_stylesheets = array();

        if (is_dir($alt_stylesheet_path)) {
            if ($alt_stylesheet_dir = opendir($alt_stylesheet_path)) {
                while (($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false) {
                    if (stristr($alt_stylesheet_file, ".css") !== false) {
                        $alt_stylesheets[] = $alt_stylesheet_file;
                    }
                }
            }
        }

        //Background Images Reader
        $bg_images_path = get_stylesheet_directory() . '/images/bg/'; // change this to where you store your bg images
        $bg_images_url = get_template_directory_uri() . '/images/bg/'; // change this to where you store your bg images
        $bg_images = array();

        if (is_dir($bg_images_path)) {
            if ($bg_images_dir = opendir($bg_images_path)) {
                while (($bg_images_file = readdir($bg_images_dir)) !== false) {
                    if (stristr($bg_images_file, ".png") !== false || stristr($bg_images_file, ".jpg") !== false) {
                        $bg_images[] = $bg_images_url . $bg_images_file;
                    }
                }
            }
        }

        /*-----------------------------------------------------------------------------------*/
        /* TO DO: Add options/functions that use these */
        /*-----------------------------------------------------------------------------------*/

        //More Options
        $uploads_arr = wp_upload_dir();
        $all_uploads_path = $uploads_arr['path'];
        $all_uploads = get_option('of_uploads');
        $other_entries = array("Select a number:", "1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19");
        $body_repeat = array("no-repeat", "repeat-x", "repeat-y", "repeat");
        $body_pos = array("top left", "top center", "top right", "center left", "center center", "center right", "bottom left", "bottom center", "bottom right");

        // Image Alignment radio box
        $of_options_thumb_align = array("alignleft" => "Left", "alignright" => "Right", "aligncenter" => "Center");

        // Image Links to Options
        $of_options_image_link_to = array("image" => "The Image", "post" => "The Post");


        /*-----------------------------------------------------------------------------------*/
        /* The Options Array */
        /*-----------------------------------------------------------------------------------*/

        // Set the Options Array
        global $of_options;
        $of_options = array();
        //
        //
        // General Settings
        //
        //
        $of_options[] = array("name" => __("General Settings", 'framework'),
            "type" => "heading");
        $of_options[] = array("name" => __("Site Logo", 'framework'),
            "desc" => __("Select the site logo", 'framework'),
            "id" => $shortname . "_site_logo",
            "std" => "",
            "type" => "media");

        $of_options[] = array("name" => __("Site Favicon", 'framework'),
            "desc" => __("Select the site favicon", 'framework'),
            "id" => $shortname . "_custom_favicon",
            "std" => "",
            "type" => "media");

        $of_options[] = array("name" => __("Footer Text", 'framework'),
            "desc" => __("Insert the footer text thats on the bottom right of the screen. You can use html tags", 'framework'),
            "id" => $shortname . "_footer_text",
            "std" => "Copyright © 2012 by <a href='http://www.themeforest.net'>collision</a>",
            "type" => "textarea");
        $of_options[] = array("name" => __("Tracking Code", 'framework'),
            "desc" => __("Insert your analytics code", 'framework'),
            "id" => $shortname . "_analytics",
            "std" => "",
            "type" => "textarea");

        //
        //
        // STYLE Settings
        //
        //
        $of_options[] = array("name" => __("Styling Options", 'framework'),
            "type" => "heading");

        $of_options[] = array("name" => __("Skin Stylesheet", 'framework'),
            "desc" => __("Select your themes alternative color scheme.", 'framework'),
            "id" => $shortname . "_alt_stylesheet",
            "std" => "skin.css",
            "type" => "select",
            "options" => $alt_stylesheets);

        $of_options[] = array("name" => "asd",
            "id" => $shortname . "_default_bg_info",
            "std" => __('The following options allow you to set the default background behavior for each page. Each of these options can be overridden on the individual post/page/portfolio level. You are in complete control.', 'framework'),
            "type" => "info");

        $of_options[] = array("name" => __('Default Background Image', 'framework'),
            "desc" => __('Set the default background image to be used on all pages.', 'framework'),
            "id" => "coll" . "_default_bg_image",
            "std" => "",
            "type" => "media");
        $repeat_options = array('no-repeat' => 'No Repeat', 'repeat' => "Repeat", 'repeat-x' => 'Repeat Horizontally', 'repeat-y' => 'Repeat Vertically');
        $of_options[] = array("name" => __('Default Background Repeat', 'framework'),
            "desc" => __('Select the default background repeat for the background image', 'framework'),
            "id" => "coll"  . "_default_bg_repeat",
            "std" => "no-repeat",
            "type" => "radio",
            "options" => $repeat_options);
        $position_options = array('left' => 'Left', 'right' => "Right", 'center' => 'Centered', 'full' => 'Full Screen');
        $of_options[] = array("name" => __('Default Background Position', 'framework'),
            "desc" => __('Select the default background position for the background image', 'framework'),
            "id" => "coll"  . "_default_bg_position",
            "std" => "left",
            "type" => "radio",
            "options" => $position_options);
        $of_options[] = array("name" => __('Default Background Color', 'framework'),
            "desc" => __('Select the default background color for pages.', 'framework'),
            "id" => "coll"  . "_default_bg_color",
            "std" => "",
            "type" => "color");
        //
        //
        // Home Settings
        //
        //

        $of_options[] = array("name" => __("Home Options", 'framework'),
            "type" => "heading");

        $of_options[] = array("name" => __("Homepage Slider", 'framework'),
            "id" => $shortname . "_home_slider_info",
            "std" => __("<b>Homepage Slider</b>: Choose a slider below", 'framework'),
            "type" => "info");
        $of_options[] = array("name" => "Flex Slider",
            "desc" => __("Check this box if you want the clasic flex slider on your homepage", 'framework'),
            "id" => $shortname . "_home_fslider_state",
            "std" => "",
            "type" => "checkbox");
        $of_options[] = array("name" => "Slider Options",
            "id" => $shortname . "_home_fslider",
            "std" => "",
            "type" => "slider");
        $of_options[] = array("name" => "Portfolio Slider",
            "desc" => __("Check this box if you want the portfolio slider on your homepage", 'framework'),
            "id" => $shortname . "_home_pslider_state",
            "std" => "",
            "type" => "checkbox");
        $of_options[] = array("name" => "Portfolio Slider Options",
            "id" => $shortname . "_home_pslider",
            "std" => "",
            "type" => "pslider");
        $of_options[] = array("name" => "Use Page Content",
            "desc" => __("Check this box if you want to display the page content on your homepage", 'framework'),
            "id" => $shortname . "_home_content_state",
            "std" => "",
            "type" => "checkbox");

        $of_options[] = array("name" => __("Homepage Info Columns", 'framework'),
            "id" => $shortname . "_home_infocolumns_info",
            "std" => __("<b>Homepage Info Columns</b>: Customize the columns below", 'framework'),
            "type" => "info");
        $of_options[] = array("name" => "Info Columns",
            "desc" => __("Check this box if you want info columns on your homepage", 'framework'),
            "id" => $shortname . "_home_infocolumns_state",
            "std" => "",
            "type" => "checkbox");
        $of_options[] = array("name" => "Info Columns Options",
            "id" => $shortname . "_home_infocolumns",
            "std" => "",
            "type" => "infocolumns");

        $of_options[] = array("name" => __("Homepage Recent Projects", 'framework'),
            "id" => $shortname . "_home_recent_projects_info",
            "std" => __("<b>Homepage Recent Projects</b>", 'framework'),
            "type" => "info");
        $of_options[] = array("name" => "Recent Projects",
            "desc" => __("Check this box if you want recent projects on your homepage", 'framework'),
            "id" => $shortname . "_home_recent_projects_state",
            "std" => "",
            "type" => "checkbox");

        $of_options[] = array("name" => __("Homepage Recent Posts", 'framework'),
            "id" => $shortname . "_home_recent_posts_info",
            "std" => __("<b>Homepage Recent Posts</b>", 'framework'),
            "type" => "info");
        $of_options[] = array("name" => "Recent Posts",
            "desc" => __("Check this box if you want recent posts on your homepage", 'framework'),
            "id" => $shortname . "_home_recent_posts_state",
            "std" => "",
            "type" => "checkbox");
        $of_options[] = array("name" => __("Homepage Clients", 'framework'),
            "id" => $shortname . "_home_clients_info",
            "std" => __("<b>Homepage Clients</b>", 'framework'),
            "type" => "info");
        $of_options[] = array("name" => __("Clients", 'framework'),
            "desc" => __("Check this box if you want clients on your homepage", 'framework'),
            "id" => $shortname . "_home_clients_state",
            "std" => "",
            "type" => "checkbox");
        $of_options[] = array("name" => __("Clients Options", 'framework'),
            "id" => $shortname . "_home_clients",
            "std" => "",
            "type" => "slider");
        //
        //
        // Portfolio Settings
        //
        //
        $of_options[] = array("name" => __("Portfolio Options", 'framework'),
            "type" => "heading");

        $of_options[] = array("name" => __("Portfolio Single Settings", 'framework'),
            "id" => $shortname . "_portfolio_single_info",
            "std" => __("<b>Portfolio Single Settings</b>", 'framework'),
            "type" => "info");
        $of_options[] = array("name" => "Related Projects",
            "desc" => __("Check this box if you want to display related projects", 'framework'),
            "id" => $shortname . "_portfolio_single_related_state",
            "std" => "",
            "type" => "checkbox");



        //
        // social
        //
        //
        $of_options[] = array("name" => __("Social Bar", 'framework'),
            "type" => "heading");

        $of_options[] = array("name" => __("Twitter", 'framework'),
            "desc" => __("Insert url", 'framework'),
            "id" => $shortname . "_twitter_url",
            "std" => "",
            "type" => "text");

        $of_options[] = array("name" => __("Facebook", 'framework'),
            "desc" => __("Insert url", 'framework'),
            "id" => $shortname . "_facebook_url",
            "std" => "",
            "type" => "text");

        $of_options[] = array("name" => __("Google Plus", 'framework'),
            "desc" => __("Insert url", 'framework'),
            "id" => $shortname . "_gplus_url",
            "std" => "",
            "type" => "text");

        $of_options[] = array("name" => __("Dribble", 'framework'),
            "desc" => __("Insert url", 'framework'),
            "id" => $shortname . "_dribble_url",
            "std" => "",
            "type" => "text");

        $of_options[] = array("name" => __("Flickr", 'framework'),
            "desc" => __("Insert url", 'framework'),
            "id" => $shortname . "_flickr_url",
            "std" => "",
            "type" => "text");


        $of_options[] = array("name" => __("Youtube", 'framework'),
            "desc" => __("Insert url", 'framework'),
            "id" => $shortname . "_youtube_url",
            "std" => "",
            "type" => "text");

        $of_options[] = array("name" => __("Vimeo", 'framework'),
            "desc" => __("Insert url", 'framework'),
            "id" => $shortname . "_vimeo_url",
            "std" => "",
            "type" => "text");

        $of_options[] = array("name" => __("LinkedIn", 'framework'),
            "desc" => __("Insert url", 'framework'),
            "id" => $shortname . "_linkedin_url",
            "std" => "",
            "type" => "text");

        $of_options[] = array("name" => __("Pinterest", 'framework'),
            "desc" => __("Insert url", 'framework'),
            "id" => $shortname . "_pinterest_url",
            "std" => "",
            "type" => "text");


    }
}
?>
