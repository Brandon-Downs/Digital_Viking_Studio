<?php
/**
 * Created by JetBrains PhpStorm.
 * User: sQrt121
 * Date: 5/9/12
 * Time: 2:04 PM
 * To change this template use File | Settings | File Templates.
 */
?>
<?php $loop = new WP_Query(array('post_type' => 'portfolio', 'posts_per_page' =>4)); ?>
<div class="info twelvecol last">
    <h2 class="title home-section-title"><?php echo coll_first_word(__('Recent Work.', 'framework')); ?></h2>
</div>
<div class="items twelvecol clearfix">
    <?php while ($loop->have_posts()) : $loop->the_post();
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
