<?php get_header('plain'); ?>

		<?php 
		global $post;
		/**
		*	Get Current page object
		**/
		$page = $wp_query->post->ID;
		$post = get_queried_object();
		?>

		<div id="main" class="cf">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>	
				
				<?php the_content(''); ?>

			<?php endwhile; endif; ?>
		</div>

		<?php get_footer(); ?>
		
	</body>
</html>