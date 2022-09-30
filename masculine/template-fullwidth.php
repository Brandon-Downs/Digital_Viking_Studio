<?php
/*
Template Name: Full Width
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
<div id="main" class="content container bottom clearfix">
    <div class="row">
        <div class="main twelvecol">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <div class="entry-content">
                <?php the_content(); ?>
            </div><!-- END CONTENT-->
            <?php endwhile; else:
            // no content
        endif; ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>