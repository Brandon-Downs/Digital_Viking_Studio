<?php get_header(); ?>


<div class="title container">
    <div class="row">
        <div class="twelvecol">
            <h1 class='text'><?php the_title(); ?></h1>

            <div class="oline">
                <canvas id="mycanvas"></canvas>
            </div>
            <div class="post navigation big ">
                <?php if (get_previous_post()) : ?>
                <div class="previous circle">
                    <?php $prev_post_id = get_previous_post()->ID;
                    echo "<a class='' title='" . get_previous_post()->post_title . "' href='" . get_permalink($prev_post_id) . "'><span class='bnp'></span></a>"
                    ?>
                </div>
                <?php endif; ?>
                <?php if (get_next_post()) : ?>
                <div class="next circle">
                    <?php $next_post_id = get_next_post()->ID;
                    echo "<a class='' title='" . get_next_post()->post_title . "' href='" . get_permalink($next_post_id) . "'><span class='bnp'></span></a>"
                    ?>
                </div>
                <?php endif; ?>
            </div>

        </div>
    </div>
</div>
<div class="assets container clearfix">
    <div class="row">
        <div class="twelvecol">
            <?php $format = get_post_format();
            if (false === $format)
                $format = 'standard';

            get_template_part('includes/' . $format); ?>
        </div>
    </div>
</div>
<div id="main" class="content container bottom clearfix">
    <div class="row">
        <div class="main eightcol">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <!--BEGIN .hentry -->
            <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
                <!--BEGIN .entry-content -->
                <div class="entry-content">
                    <?php the_content(__('Read More', 'framework')); ?>
                    <!--END .entry-content -->
                </div>
                <div class="entry-extra clearfix">
                    <?php  get_template_part('includes/post-meta');?>
                    <?php custom_social_share(); ?>
                </div>

                <!--END .hentry-->
            </div>
            <div class="comments">
                <?php comments_template('', true); ?>
            </div>
            <?php endwhile; ?>


            <?php else:
            // no content
        endif; ?>
        </div>
        <div class="sidebar fourcol last">
            <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar()) ?>
        </div>
    </div>

</div>





<?php get_footer(); ?>
