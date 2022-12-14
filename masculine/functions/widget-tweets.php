<?php


/*
 * Add function to widgets_init that'll load our widget.
 */
add_action( 'widgets_init', 'col_tweets_widgets' );

/*
 * Register widget.
 */
function col_tweets_widgets() {
	register_widget( 'Col_Tweet_Widget' );
}

/*
 * Add Javascript
 */

function load_tweeter_js() {
	if( !is_admin() ){
		wp_register_script('col-twitter-widget', get_template_directory_uri() . '/functions/js/twitter.js');
		wp_enqueue_script('col-twitter-widget');
	}
}
add_action('init', 'load_tweeter_js');


/*
 * Widget class.
 */
class col_tweet_widget extends WP_Widget {

	/* ---------------------------- */
	/* -------- Widget setup -------- */
	/* ---------------------------- */
	
	function Col_Tweet_Widget() {
	
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'col_tweet_widget', 'description' => __('Latest tweets widget', 'fifty') );

		/* Widget control settings. */
//		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'col_tweet_widget' );

		/* Create the widget. */
		$this->WP_Widget( 'col_tweet_widget', __('Custom Latest Tweets','fifty'), $widget_ops );
	}

	/* ---------------------------- */
	/* ------- Display Widget -------- */
	/* ---------------------------- */
	
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		
		$twitter_username = $instance['username'];
		$twitter_postcount = $instance['postcount'];
		$tweettext = $instance['tweettext'];
		
		echo $before_widget;

		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;
			
		$id = rand(0,999);

		/* Display Latest Tweets */
		?>
			<script type="text/javascript">
			jQuery(document).ready(function($){
				$.getJSON('http://api.twitter.com/1/statuses/user_timeline/<?php echo $twitter_username; ?>.json?count=<?php echo $twitter_postcount; ?>&callback=?', function(tweets){
					$("#twitter_update_list_<?php echo $id; ?>").html(format_tweets(tweets));
				});
			});
			</script>
            <ul id="twitter_update_list_<?php echo $id; ?>" class="twitter">
                <li><p></p></li>
            </ul>
            
            <?php if ($tweettext) { ?>
            
            <a class="superlink" href="http://twitter.com/<?php echo $twitter_username; ?>" class="twitter-link"><?php echo $tweettext; ?></a>
		
		<?php }

		/* After widget (defined by themes). */
		echo $after_widget;
	}

	/* ---------------------------- */
	/* ------- Update Widget -------- */
	/* ---------------------------- */
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['username'] = strip_tags( $new_instance['username'] );
		$instance['postcount'] = strip_tags( $new_instance['postcount'] );
		$instance['tweettext'] = strip_tags( $new_instance['tweettext'] );



		return $instance;
	}
	
	/* ---------------------------- */
	/* ------- Widget Settings ------- */
	/* ---------------------------- */
	
	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	 
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array(
		'title' => 'Latest Tweets',
		'username' => 'aplusk',
		'postcount' => '2',
		'tweettext' => 'Follow Me',
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'fifty') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>

		<!-- Username: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'username' ); ?>"><?php _e('Twitter Username e.g. envato', 'fifty') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'username' ); ?>" name="<?php echo $this->get_field_name( 'username' ); ?>" value="<?php echo $instance['username']; ?>" />
		</p>
		
		<!-- Postcount: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'postcount' ); ?>"><?php _e('Number of tweets (max 20)', 'fifty') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'postcount' ); ?>" name="<?php echo $this->get_field_name( 'postcount' ); ?>" value="<?php echo $instance['postcount']; ?>" />
		</p>
		
		<!-- Tweettext: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'tweettext' ); ?>"><?php _e('Follow Text e.g. Follow me on Twitter', 'fifty') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'tweettext' ); ?>" name="<?php echo $this->get_field_name( 'tweettext' ); ?>" value="<?php echo $instance['tweettext']; ?>" />
		</p>
		
	<?php
	}
}

?>