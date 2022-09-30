<?php 
/**
*	Template Name: Homepage
**/
get_header(); 
global $post;

$page = $wp_query->post->ID;

?>

<?php 
	$slides = get_posts(array(
		'post_type' => 'post', //If your CPT slug is not slide replace slide with your slug
		'post_status' => 'publish',
		'meta_key'    => '_thumbnail_id', //Checks if the post has a feat img
		'orderby' => 'menu_order',
		'order' => 'ASC',
		'posts_per_page' => -1
	));
?>


<?php if($slides): ?>
	<div id="StellarSlider">
		<ul class="cf slides">
			<?php foreach($slides as $post): setup_postdata($post); ?>
				<li class="slide"><?php the_post_thumbnail('fullBanner'); ?></li>
			<?php endforeach; ?>
			<?php wp_reset_postdata(); ?>
			<?php wp_reset_query(); ?>
		</ul>
	</div>
<?php endif; ?>

            <div class="container">
                <div class="gridRow">
                    <section id="main-content">
                        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                            <article <?php post_class() ?> id="post-<?php the_ID(); ?>">
                                <header>
                                    <h1><?php the_title(); ?></h1>
                                </header>

                                <?php the_content(''); ?>
                            </article>

                        <?php endwhile; endif; ?>
                    </section>

                    <?php //get_sidebar(); ?>
                </div>
            </div>

<?php //if(!is_front_page()) : ?>
        <!--</div> /.gridRow -->
    <!--</div> /.container -->
<?php //endif; ?>
</div><!-- /#main -->

<div class="parallax-container" data-parallax="scroll" data-image-src="<?php bloginfo('template_url'); ?>/images/body.jpg">
    <div class="parallax-content">
        <h1>Parallax Example</h1>
        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Phasellus hendrerit. Pellentesque aliquet nibh nec urna. In nisi neque, aliquet vel, dapibus id, mattis vel, nisi. Sed pretium, ligula sollicitudin laoreet viverra, tortor libero sodales leo, eget blandit nunc tortor eu nibh. Nullam mollis. Ut justo. Suspendisse potenti. Sed egestas, ante et vulputate volutpat, eros pede semper est, vitae luctus metus libero eu augue. Morbi purus libero, faucibus adipiscing, commodo quis, gravida id, est. Sed lectus. Praesent elementum hendrerit tortor. Sed semper lorem at felis. Vestibulum volutpat, lacus a ultrices sagittis, mi neque euismod dui, eu pulvinar nunc sapien ornare nisl. Phasellus pede arcu, dapibus eu, fermentum et, dapibus sed, urna.</p>
    </div>

</div>

<div class="container normal-block-example">
    
    <h1>Normal Block Example</h1>
    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Phasellus hendrerit. Pellentesque aliquet nibh nec urna. In nisi neque, aliquet vel, dapibus id, mattis vel, nisi. Sed pretium, ligula sollicitudin laoreet viverra, tortor libero sodales leo, eget blandit nunc tortor eu nibh. Nullam mollis. Ut justo. Suspendisse potenti. Sed egestas, ante et vulputate volutpat, eros pede semper est, vitae luctus metus libero eu augue. Morbi purus libero, faucibus adipiscing, commodo quis, gravida id, est. Sed lectus. Praesent elementum hendrerit tortor. Sed semper lorem at felis. Vestibulum volutpat, lacus a ultrices sagittis, mi neque euismod dui, eu pulvinar nunc sapien ornare nisl. Phasellus pede arcu, dapibus eu, fermentum et, dapibus sed, urna.</p>

</div>

<div class="animationOnScroll">
    <h1>Animation On Scroll Examples</h1>
    <div class="item" data-aos="fade-up">1</div>
    <div class="item" data-aos="fade-down">2</div>
    <div class="item" data-aos="fade-right">3</div>
    <div class="item" data-aos="fade-left">4</div>

    <div class="item" data-aos="zoom-in">5</div>
    <div class="item" data-aos="zoom-out">6</div>

    <div class="item" data-aos="slide-up">7</div>

    <div class="item" data-aos="flip-up">8</div>
    <div class="item" data-aos="flip-down">9</div>
    <div class="item" data-aos="flip-right">10</div>
    <div class="item" data-aos="flip-left">11</div>
</div>
     
     

<?php get_footer(); ?>