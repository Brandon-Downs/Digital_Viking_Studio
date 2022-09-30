<?php
/*
Template Name: Portfolio-Vertical
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
<div id="main" class="content container pvertical clearfix">
    <?php $loop = new WP_Query(array('post_type' => 'portfolio', 'posts_per_page' => -1));
    while ($loop->have_posts()) : $loop->the_post();
        $thumb = get_post_meta(get_the_ID(), 'thumbnail', true);
        ?>
        <div class="row">
            <div class="portfolio item twelvecol">
                <div class="asset">
                    <a class="thumb" href="<?php echo get_permalink(get_the_ID())?>">
                        <img src="<?php echo $thumb ?>"/>
                    </a>
                </div>
                <div class="info">
                    <div class="title">
                        <h1 class="text"><a href="<?php echo get_permalink(get_the_ID())?>"><?php the_title();?></a>
                        </h1>
                    </div>
                    <div class="tags">

                        <?php  $terms = get_the_terms(get_the_ID(), 'port-cat');
                        if ($terms && !is_wp_error($terms)) :
                            $tags = array();
                            foreach ($terms as $term) {
                                $tags[] = $term->slug;
                            }
                            $showTags = join("/", $tags);
                            echo $showTags;
                        endif;?>
                        <!--                            <a href="-->
                            <?php //echo get_post_meta(get_the_ID(), 'url', true); ?><!--"-->
                        <!--                               class="superlink"-->
                        <!--                               title="-->
                            <?php //echo get_post_meta(get_the_ID(), 'url', true); ?><!--">-->
                        <!--                                --><?php //_e('Launch Project', 'framework'); ?>
                        <!--                            </a>-->

                    </div>

                    <?php $lproj = get_post_meta(get_the_ID(), 'url', true);
                    $client = get_post_meta(get_the_ID(), 'client', true);
                    if (!empty($lproj)) {
                        ?>
                        <div class="launch">
                            <a href="<?php echo get_post_meta(get_the_ID(), 'url', true); ?>"
                               class="superlink"
                               title="<?php echo get_post_meta(get_the_ID(), 'url', true); ?>">
                                <?php echo $client ?>
                            </a>
                        </div>
                        <?php } else { ?>
                        <div class="launch"> <?php _e('In Development', 'framework'); ?>  </div>
                        <?php } ?>

                </div>
            </div>
        </div>
        <?php endwhile; ?> <!-- END THE LOOP -->
    <?php wp_reset_postdata(); ?>

    <!-- END ITEMS -->
</div>
<?php get_footer(); ?>