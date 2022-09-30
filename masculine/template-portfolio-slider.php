<?php
/*
Template Name: Portfolio-Slider
*/
?>
<?php get_header(); ?>
<div class="title container">
    <div class="row">
        <div class="twelvecol">
            <h1 class='text'><?php the_title(); ?></h1>
            <div class="oline">
                <canvas id="mycanvas"></canvas>
            </div>
        </div>
    </div>
</div>
<div id="main" class="content container clearfix">
    <div class="row">
        <div class="pslider twelvecol clearfix">
            <div class="assets">
                <ul class="itemcontainer clearfix">
                    <!--  START THE LOOP  -->
                    <?php $loop = new WP_Query(array('post_type' => 'portfolio', 'posts_per_page' => -1));
                    while ($loop->have_posts()) : $loop->the_post();
                        $thumb = get_post_meta(get_the_ID(), 'thumbnail', true);
                        ?>
                        <li>
                            <div id="post-<?php the_ID();?>" <?php post_class();?>>
                                <a class="thumb" href="<?php echo get_permalink(get_the_ID())?>">
                                    <img src="<?php echo $thumb ?>" alt=""/>
                                    <span class="icon-plus"></span>
                                </a>
                                <img class="shadow"
                                     src="<?php echo get_stylesheet_directory_uri(); ?>/images/slider_shadow.png"/>
                            </div>

                        </li>
                        <?php endwhile; ?> <!-- END THE LOOP -->
                    <?php // wp_reset_postdata(); ?>
                </ul>
            </div>
            <div class="info">
                <ul class="itemcontainer">
                    <?php while ($loop->have_posts()) : $loop->the_post() ?>
                    <li>
                        <h3 class="title">
                            <a href="<?php echo get_permalink(get_the_ID())?>"><?php the_title();?></a>
                        </h3>
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
<!--                            <a href="--><?php //echo get_post_meta(get_the_ID(), 'url', true); ?><!--"-->
<!--                               class="superlink"-->
<!--                               title="--><?php //echo get_post_meta(get_the_ID(), 'url', true); ?><!--">-->
<!--                                --><?php //_e('Launch Project', 'framework'); ?>
<!--                            </a>-->
                        </span>
<!--                        <span> --><?php //the_excerpt() ?><!-- </span>-->
                    </li>


                    <?php endwhile; ?> <!-- END THE LOOP -->
                    <?php wp_reset_postdata(); ?>
                </ul>
            </div>
        </div>
    </div>
    <!-- END ITEMS -->
</div>
<?php get_footer(); ?>