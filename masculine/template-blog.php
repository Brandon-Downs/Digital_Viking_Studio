<?php
/*
Template Name: Blog on HomePage
*/
?>
<?php get_header(); ?>
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

    <?php      $paged = (get_query_var('page')) ? get_query_var('page') : 1;
    query_posts('post_type=post&paged='.$paged);     ?>
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
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

    <?php wp_reset_query(); ?>
</div>






<?php get_footer(); ?>