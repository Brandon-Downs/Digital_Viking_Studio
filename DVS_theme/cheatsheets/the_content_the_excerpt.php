<?php 
/* WordPress Cheatsheet - Displaying content and excerpts in templates */

/********************************************** POST CONTENT ********/
/* the_content() 
** the_content() can be used only inside the main loop
** the_content('Read More &raquo;'); will only break the content where you have inserted a "More Tag"
	
	<?php
		//Show the post content - No Read More Link
	 	the_content();
	?>

	<?php
		//Show the post content - Read More Link Breaks and Shows where More Tag was inserted
		$moreText = 'Read More &raquo;';
		the_content($moreText);
	?>
	
	<?php 
		//Show the post content of a single post outside of the main loop, if you know the post ID
		$post_id = 14; //Replace 14 with your post/page/post type id
		$myPost = ready_post($post_id); //The function
		
		//Here we make sure that a post was actually found
		if($myPost){
			the_content('Read More');
			
			//These are important so that the rest of your page will load properly after using this function
			wp_reset_postdata();
			wp_reset_query();
		}
	?>
	
	<?php 
		//Show the post content of multiple posts outside of the main loop - Read More Link Breaks and Shows where More Tag was inserted
		$args = array(
			'post_type' => 'post',
			'posts_per_page' => 5
		);
		$myPosts = get_posts($args);
		
		if($myPosts){
			foreach($myPosts as $post){ setup_postdata($post);
				global $more;
				$more = 0;
				
				$moreText = 'Read More &raquo;';
				the_content($moreText);
			}
			wp_reset_postdata();
			wp_reset_query();
		}
	?>
	
	<?php 
		//If all else fails you can grab the content using a post's ID and use apply_filters();
		$postID = 14; //Replace this with your post id
		$myPost = get_post($postID);
		$myPostContent = $myPost->post_content;
		
		echo apply_filters('the_content', $myPostContent);
	?>
*/

/********************************************** POST EXCERPT *******/
/*  the_excerpt() 
**  the_excerpt() can be used only inside the main loop
**  the_excerpt() will break after a set number of characters and add predefined text to the end of the characters. - These are set up in functions.php

<?php
	//Show the post excerpt of multiple posts outside of the main loop
	$args = array(
		'post_type' => 'post',
		'posts_per_page' => 5
	);
	$myPosts = get_posts($args);
	
	if($myPosts){
		foreach($myPosts as $post){ setup_postdata($post);
			the_excerpt();
		}
		wp_reset_postdata();
		wp_reset_query();
	}
?>	

<?php 
	//Show the post excerpt of a single post outside of the main loop, if you know the post ID
	$post_id = 14; //Replace 14 with your post/page/post type id
	$myPost = ready_post($post_id); //The function
	
	//Here we make sure that a post was actually found
	if($myPost){
		the_excerpt();
		
		//These are important so that the rest of your page will load properly after using this function
		wp_reset_postdata();
		wp_reset_query();
	}
?>

<?php 
	//If all else fails you can grab the content using a post's ID and use apply_filters();
	$post_id = 14; //Replace 14 with your post/page/post type id
	$myPost = ready_post($post_id); //The function
	
	//I use post_content here because post_exceprt only contains text which has been entered into the "Excerpt" field
	//in the admin backend. If the user has only entered content then post_excerpt will be empty. If you want to show
	//a custom excerpt you would use $myPost->post_excerpt; 
	$myPostContent = $myPost->post_content;
	
	
	echo apply_filters('the_excerpt', $myPostContent);
?>

*/


?>