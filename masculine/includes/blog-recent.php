<?php
/**
 * Created by JetBrains PhpStorm.
 * User: sQrt121
 * Date: 5/9/12
 * Time: 2:04 PM
 * To change this template use File | Settings | File Templates.
 */
?>
<?php global $data;

$blog = get_post(get_option('page_for_posts'));
$blog_url = get_permalink($blog->ID); //get the slides array

?>
<div class="info twelvecol last">
    <div class="line">
        <div class="color">
        </div>
    </div>
    <h3 class="title home-section-title"><?php echo coll_first_word(__('Recent Posts.', 'framework')); ?></h3>
</div>
<div class="items">
    <?php $loop = new WP_Query(array('post_type' => 'post', 'posts_per_page' => 4));
    while ($loop->have_posts()) : $loop->the_post();?>

        <div
            id="post-<?php the_ID();?>" <?php echo "class='" . implode(' ', get_post_class('threecol')); if (($loop->current_post + 1) == $loop->post_count) echo ' last'; echo "'"; ?>>
            <h4 class="title"><a href="<?php echo get_permalink(get_the_ID())?>"><?php the_title(); ?></a></h4>
            <!--            <span class="date">--><?php //echo get_the_date();?><!--</span>-->
            <?php the_excerpt();?>
            <a class='superlink more-link'
               href="<?php the_permalink();?>"><?php _e('Read more', 'framework');?>
            </a>
        </div>
        <?php endwhile; ?> <!-- END THE LOOP -->
    <?php wp_reset_postdata(); ?>
</div>
