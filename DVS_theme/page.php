<?php get_header(); 
global $post;
/**
*	Get Current page object
**/
$page = $wp_query->post->ID;
$post = get_queried_object();
?>

<section id="main-content" class="fullWidth">

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<?php get_template_part('part', 'breadcrumbs'); ?>
	
		<article <?php post_class('	') ?> id="post-<?php the_ID(); ?>">
			<header>
				<h1><?php the_title(); ?></h1>
			</header>
			
			<?php the_content(''); ?>
	
		</article>
		
		<?php if(!get_field('hide_child_pages')): ?>   
			<section class="contentBlock childrenBlock fullWidth">
				<?php 
					global $post;
					$postChildren =& get_children(array(
						'post_parent' => $post->ID,
						'post_type' => 'page',
						'post_status' => 'publish',
						'posts_per_page' => -1,
						'orderby' => 'menu_order',
						'order' => 'ASC' 
					)); 
				?>
				
				<?php if($postChildren): ?>

					<?php if(get_field('child_pages_heading')): ?>                                   
						<h2 class="centerHeading"><?php the_field('child_pages_heading'); ?></h2>
					<?php endif; ?>					

					<div class="childrenList">

						<?php foreach($postChildren as $post): setup_postdata($post); ?>
			                <a href="<?php the_permalink(); ?>" id="child-<?php the_ID(); ?>" <?php post_class("cf pictureBox"); ?>>
			                	
			                	<?php if(has_post_thumbnail()): ?>
			                		<?php the_post_thumbnail('news'); ?>
	                            <?php endif; ?>

	                            <div class="newOverlay"></div>
	                            
	                            <div class="newsText">                                
	                                <h3><?php the_title(); ?></h3>
	                                <span>Read<i class="fas fa-long-arrow-alt-right"></i></span>  
	                            </div>

			                    <!-- <div class="imgWrap">
			                    	<?php if(has_post_thumbnail()): ?>
				                        <?php the_post_thumbnail('listing-img', array('class' => 'alignleft')); ?>
				                    <?php endif; ?>
				                </div>
			                    
			                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			                    
			                    <?php the_excerpt(); ?>

			                    <?php //the_content(); ?> -->

			                </a><!-- /.child -->
						<?php endforeach; ?>
					</div>
					<?php wp_reset_postdata(); //Resets the $post variable ?>
					<?php wp_reset_query(); //Resets the WP_Query object ?>
				<?php endif; ?>			

				<?php if(get_field('below_all_content')): ?>      
					<?php if(the_field('below_all_content')) ?>     
				<?php endif; ?>

			</section>

		<?php endif; ?>
	
	<?php endwhile; endif; ?>

</section>

<?php //get_sidebar(); ?>
<?php get_footer(); ?>