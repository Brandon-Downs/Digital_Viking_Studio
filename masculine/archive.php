<?php get_header(); ?>
<?php /* Get author data */
$curauth = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author'));
?>
<div class="title container">
    <div class="row">
        <div class="twelvecol">
            <?php
            global $wp_query;
            $postid = get_option('page_for_posts');
            $title = get_the_title($postid);
            echo "<h1 class='text'>$title</h1>";
            ?>
            <div class="oline">
                <canvas id="mycanvas"></canvas>
            </div>
        </div>
    </div>
</div>




<div id="main">
    <?php if (have_posts()) : ?>
    <div class="results container clearfix">
        <div class="row">
            <div class="twelvecol">
                <div class="archive-type">
                    <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
                    <?php /* If this is a category archive */
                    if (is_category()) { ?>
                        <h3 class="title"><?php printf(__('All posts in %s', 'framework'), single_cat_title('', false)); ?></h3>
                        <?php /* If this is a tag archive */
                    } elseif (is_tag()) {
                        ?>
                        <h3 class="title"><?php printf(__('All posts tagged %s', 'framework'), single_tag_title('', false)); ?></h3>
                        <?php /* If this is a daily archive */
                    } elseif (is_day()) {
                        ?>
                        <h3 class="title"><?php _e('Archive for', 'framework') ?> <?php the_time('F jS, Y'); ?></h3>
                        <?php /* If this is a monthly archive */
                    } elseif (is_month()) {
                        ?>
                        <h3 class="title"><?php _e('Archive for', 'framework') ?> <?php the_time('F, Y'); ?></h3>
                        <?php /* If this is a yearly archive */
                    } elseif (is_year()) {
                        ?>
                        <h3 class="title"><?php _e('Archive for', 'framework') ?> <?php the_time('Y'); ?></h3>
                        <?php /* If this is an author archive */
                    } elseif (is_author()) {
                        ?>
                        <h3 class="title"><?php _e('All posts by', 'framework') ?> <?php echo $curauth->display_name; ?></h3>
                        <?php /* If this is a paged archive */
                    } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {
                        ?>
                        <h3 class="title"><?php _e('Archives', 'framework') ?></h3>
                        <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <?php while (have_posts()) : the_post(); ?>
        <div class="container clearfix bdivider">
            <div class="row">
                <div class="twelvecol">
                    <!--BEGIN .hentry -->
                    <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
                        <div class="entry-title">
                            <a href="<?php the_permalink(); ?>">
                                <h1 class="inv"><?php the_title(); ?></h1>

                                <div class="trans">
                                    <h1 class=" default"><?php the_title(); ?></h1>

                                    <h1 class="over"><?php the_title(); ?></h1>
                                </div>
                            </a>
                        </div>
                        <div class="entry-meta">
                            <ul class="inv">
                                <li class="meta-author"><?php _e('By ', 'framework'); the_author_posts_link(); ?></li>
                                <li class="meta-date"><?php  _e('On ', 'framework'); echo get_the_date();  ?></li>
                            </ul>
                            <div class="trans">
                                <ul class="over">
                                    <li class="meta-author"><?php _e('By ', 'framework'); the_author_posts_link(); ?></li>
                                    <li class="meta-date"><?php  _e('On ', 'framework'); echo get_the_date();  ?></li>
                                </ul>
                            </div>
                        </div>
                        <!--END .hentry-->
                    </div>
                </div>
            </div>

        </div>
        <?php endwhile; ?>
    <?php if (get_next_posts_link() || get_previous_posts_link()) : ?>
        <div class="container clearfix">
            <div class="row">

                <!--BEGIN navigation -->

                <div class="blog-navigation twelvecol clearfix">

                    <div class="next">
                        <?php if (get_next_posts_link()) {
                        $npl = explode('"', get_next_posts_link());
                        echo "<a class='superlink' href='" . $npl[1] . "'><span class='icon'></span> " . __('Older Entries', 'framework') . "</a>";
                    }
                        ?>
                    </div>
                    <div class="prev">
                        <?php if (get_previous_posts_link()) {
                        $ppl = explode('"', get_previous_posts_link());
                        echo "<a class='superlink' href='" . $ppl[1] . "'>" . __('Newer Entries', 'framework') . " <span class='icon'></span></a>";
                    }
                        ?>
                    </div>

                    <!--END navigation -->
                </div>
            </div>
        </div>
        <?php endif; ?>

    <?php else:
// no content
endif; ?>
</div>



<?php get_footer(); ?>