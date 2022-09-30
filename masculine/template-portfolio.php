<?php
/*
Template Name: Portfolio
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
        <div class="filter twelvecol clearfix">
            <ul class="categories">
                <?php
                $taxonomy = 'port-cat';
                $tax_terms = get_terms($taxonomy, 'orderby=none');
                echo '<li><a href="" class="superlink" data-tag="all">' . __('All', 'framework') . '</a></li>';
                foreach ($tax_terms as $tax_term) {
                    echo '<li><a href="" class="superlink"  data-tag="' . $tax_term->slug . '">' . $tax_term->name . '</a></li>';
                }
                ?>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="items twelvecol clearfix">
            <!--  START THE LOOP  -->
            <?php $loop = new WP_Query(array('post_type' => 'portfolio', 'posts_per_page' => -1));
            while ($loop->have_posts()) : $loop->the_post();
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
                <?php endwhile; ?> <!-- END THE LOOP -->
            <?php wp_reset_postdata(); ?>
        </div>
    </div>
    <!-- END ITEMS -->
</div>
<?php get_footer(); ?>