<?php


// Add function to widgets_init that'll load our widget
add_action('widgets_init', 'reg_col_widget_portfolio_posts');

// Register widget
function reg_col_widget_portfolio_posts()
{
    register_widget('Col_Widget_Portfolio_Posts');
}

class Col_Widget_Portfolio_Posts extends WP_Widget
{

    function __construct()
    {
        parent::WP_Widget( /* Base ID */
            'col_widget_portfolio_posts', /* Name */
            __('Custom Latest Portfolio Posts', 'framework'), array('description' => __('This is a widget that will display custom recent portfolio posts', 'framework')));
    }

    function widget($args, $instance)
    {
        extract($args);

        // Our variables from the widget settings
        $title = apply_filters('widget_title', $instance['title']);
        $postcount = $instance['postcount'];

        // Before widget (defined by theme functions file)
        echo $before_widget;

        // Display the widget title if one was input
        if ($title)
            echo $before_title . $title . $after_title;

        // Display Posts

        $query_args = array(
            'post_type' => 'portfolio',
            'posts_per_page' => $postcount,
            'orderby' => 'date',
            'order' => 'DESC'
        );
        $the_query = new WP_Query($query_args);

        if ($the_query->have_posts()) {
            echo "<div class='items clearfix'>";
            while ($the_query->have_posts()) {
                $the_query->the_post();
                $thumb = get_post_meta(get_the_ID(), 'thumbnail', true);
                ?>
            <div id="post-<?php the_ID();?>" <?php post_class();?>>
                <a class="thumb" href="<?php echo get_permalink(get_the_ID())?>">
                    <img src="<?php echo $thumb ?>" alt=""/>
                    <span class="overlay"></span>
                    <span class="title"><?php the_title(); ?></span>
                    <span class="tags">
                        <?php  $terms = get_the_terms(get_the_ID(), 'port-cat');

                        if ($terms && !is_wp_error($terms)) :

                            $tags = array();

                            foreach ($terms as $term) {
                                $tags[] = $term->slug;
                            }

                            $showTags = join(" &middot ", $tags);
                            echo $showTags;
                        endif;?>

                    </span>
                </a>
            </div>


            <?php

            }

            echo "</div>";
        }
        ?>



    <?php
        wp_reset_postdata();
        // After widget (defined by theme functions file)
        echo $after_widget;
    }


/*-----------------------------------------------------------------------------------*/
/*	Update Widget
/*-----------------------------------------------------------------------------------*/

    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;

        // Strip tags to remove HTML (important for text inputs)
        $instance['title'] = strip_tags($new_instance['title']);
        // No need to strip tags
        $instance['postcount'] = $new_instance['postcount'];

        return $instance;
    }


/*-----------------------------------------------------------------------------------*/
/*	Widget Settings (Displays the widget settings controls on the widget panel)
/*-----------------------------------------------------------------------------------*/

    function form($instance)
    {

        // Set up some default widget settings
        $defaults = array(
            'title' => 'Latest Portfolio Posts',
            'postcount' => '3'
        );

        $instance = wp_parse_args((array)$instance, $defaults); ?>

    <!-- Widget Title: Text Input -->
    <p>
        <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'framework') ?></label>
        <input class="widefat" type="text" id="<?php echo $this->get_field_id('title'); ?>"
               name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>"/>
    </p>

    <!-- Postcount: Text Input -->
    <p>
        <label for="<?php echo $this->get_field_id('postcount'); ?>"><?php _e('Number of Posts:', 'framework') ?></label>
        <input class="widefat" type="text" id="<?php echo $this->get_field_id('postcount'); ?>"
               name="<?php echo $this->get_field_name('postcount'); ?>" value="<?php echo $instance['postcount']; ?>"/>
    </p>


    <?php

    }
}