<?php get_header(); ?>

<section id="main-content">

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
			<header>
				<h1><?php the_title(); ?></h1>
				<p class="postMeta">
	            	<time datetime="<?php the_time('Y-m-d')?>">Posted <?php the_time('F jS, Y') ?></time><?php if(has_category()): ?><span> in <?php the_category(', '); ?></span><?php endif; ?>
	            	<!-- <span class="author">by <?php the_author(); ?></span>.             	
					<?php if ( comments_open() ) : ?> - <a class="comment" href="<?php the_permalink(); ?>#comments"><?php comments_number('0 Comments', '1 Comment', '% Comments'); ?></a><?php endif; ?> -->
	            </p>
			</header>
			
	        <?php if(has_post_thumbnail()): ?>
	        	<?php the_post_thumbnail('large', array('class' => 'aligncenter', 'title' => get_the_title())); ?>
			<?php endif; ?>
			
			<?php the_content(); ?>
			
		</article>
		
		<?php //comments_template(); ?>
		
	<?php endwhile; endif; ?>

</section>

<?php //get_sidebar(); ?>
<?php get_footer(); ?>