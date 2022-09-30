<?php

/*

Template Name: Home Page

*/

?>

<?php get_header(); ?>

<div class="title container">

    <div class="row">

        <div class="twelvecol">

            <!-- <h1 class='text'><?php the_title(); ?></h1> -->



            <div class="oline">

                <canvas id="mycanvas"></canvas>

            </div>

        </div>

    </div>

</div>

<div id="main" class="content container clearfix">

    <!-- slider -->

    <?php

    $usefs = $data['iter_home_fslider_state'];

    $slides = $data['iter_home_fslider']; //get the slides array

    if (!empty($usefs) && $usefs) :    ?>

        <div class="slider row">

            <div class="<?php if ($data['iter_home_content_state']) {

                echo "eightcol";

            } else {

                echo "twelvecol";

            } ?> clearfix">

                <div class="flexslider">

                    <ul class="slides">

                        <?php foreach ($slides as $slide) { ?>

                        <li>

                            <?php if (!empty($slide['link'])) { ?>

                            <a href="<?php echo $slide['link']; ?>"><img src="<?php echo $slide['url']; ?>"/></a>

                            <?php } else { ?>

                            <img src="<?php echo $slide['url']; ?>"/>

                            <?php } ?>

                            <?php if (!empty($slide['title']) || !empty($slide['description'])) { ?>

                            <div class="flex-caption">

                                <?php if (!empty($slide['title'])) { ?>

                                <h1 class="title"><?php echo $slide['title']; ?></h1>

                                <?php } ?>

                                <?php if (!empty($slide['description'])) { ?>

                                <p class="descr"><?php echo $slide['description']; ?></p>

                                <?php } ?>

                            </div>



                            <?php } ?>

                        </li>

                        <?php } ?>

                    </ul>

                </div>

                <div class="fshadow">

                    <img class="shadow"

                         src="<?php echo get_stylesheet_directory_uri(); ?>/images/slider_shadow.png"/>

                </div>

            </div>

            <?php if ($data['iter_home_content_state']) : ?>

            <div class="text fourcol last">

                <?php

//                $postid = $wp_query->post->ID;

//                $title = get_the_title($postid);

//                if (!empty($title)) {

//                    echo "<h2 class='title'>$title</h2>";

//                }



                ck_the_content();

                ?>

            </div>

            <?php endif ?>

        </div>

        <?php endif ?>

    <?php

    $useps = $data['iter_home_pslider_state'];

    $slides = $data['iter_home_pslider']; //get the slides array

    if (!empty($useps) && $useps) :    ?>

        <div class="slider row">

            <div class="<?php if ($data['iter_home_content_state']) {

                echo "eightcol";

            } else {

                echo "twelvecol";

            } ?> pslider clearfix">

                <div class="assets">

                    <ul class="itemcontainer clearfix">



                        <?php

                        $pids = array();

                        foreach ($slides as $slide) {

                            $pids[] = $slide['id'];

                        }



                        //START THE LOOP

                        //$loop = new WP_Query(array('post_type' => 'portfolio', 'post__in' => $pids,'orderby' => 'none', 'posts_per_page' => -1));

                        //while ($loop->have_posts()) : $loop->the_post();

                        foreach ($pids as $pID) {

                            ?>

                            <li>

                                <div

                                    id="post-<?php echo $pID;?>" <?php echo "class='" . implode(' ', get_post_class('', $pID)) . "'";?>>

                                    <a class="thumb" href="<?php echo get_permalink($pID)?>">

                                        <img src="<?php echo get_post_meta($pID, 'thumbnail', true); ?>" alt=""/>

                                        <span class="icon-plus"></span>

                                    </a>

                                    <!--                                    <div class="shadow-small"></div>-->



                                    <img class="shadow"

                                         src="<?php echo get_stylesheet_directory_uri(); ?>/images/slider_shadow.png"/>



                                </div>



                            </li>

                            <?php }// endwhile; ?> <!-- END THE LOOP -->

                        <?php // wp_reset_postdata(); ?>

                    </ul>

                </div>

                <div class="info">

                    <ul class="itemcontainer">

                        <?php //while ($loop->have_posts()) : $loop->the_post()

                        foreach ($pids as $pID) {

                            ?>

                            <li>

                                <h3 class="title">

                                    <a href="<?php echo get_permalink($pID)?>"><?php echo get_the_title($pID);?></a>

                                </h3>

                                <span class="tags">

                                    <?php  $terms = get_the_terms($pID, 'port-cat');

                                    if ($terms && !is_wp_error($terms)) :

                                        $tags = array();

                                        foreach ($terms as $term) {

                                            $tags[] = $term->slug;

                                        }

                                        $showTags = join(" &middot ", $tags);

                                        echo $showTags;

                                    endif;?>



                                </span>

                            </li>





                            <?php }//endwhile; ?> <!-- END THE LOOP -->

                        <?php //wp_reset_postdata(); ?>

                    </ul>

                </div>

            </div>

            <?php if ($data['iter_home_content_state']) : ?>

            <div class="text fourcol last">

                <?php

//                $postid = $wp_query->post->ID;

//                $title = get_the_title($postid);

//                if (!empty($title)) {

//                    echo "<h2 class='title'>$title</h2>";

//                }



                ck_the_content();

                ?>

            </div>

            <?php endif ?>

        </div>

        <?php endif ?>





</div>









<div class="bottom container <?php if (!$usefs && !$useps) echo "no-slider" ?> clearfix">

    <?php

    $usepc = $data['iter_home_content_state'];

    if (!!empty($usefs) && $usepc) : ?>

        <div class="page-content row">

            <div class="text twelvecol">

                <?php  ck_the_content(); ?>

            </div>

        </div>

        <?php endif ?>



    <!-- info columns -->

    <?php

    $useic = $data['iter_home_infocolumns_state'];

    $infocolumns = $data['iter_home_infocolumns']; //get the slides array

    if (!empty($useic) && $useic) :    ?>

        <div class="infocolumns row">

            <?php foreach ($infocolumns as $column) { ?>

            <div

                class="column <?php echo $column['width']; ?> <?php  if ($column === end($infocolumns)) echo 'last'; ?>">

                <h2 class="title"> <?php echo coll_first_word($column['title']); ?></h2>



                <p class="descr"><?php echo $column['description']; ?></p>

                <?php if (!empty($column['link'])): ?>

                <a class='superlink' href="<?php echo $column['url'];?>"><?php echo $column['link'];?></a>



                <?php endif ?>

            </div>



            <?php } ?>





        </div>

        <?php endif ?>

    <!-- recent portfolio -->

    <?php

    $usepr = $data['iter_home_recent_projects_state'];

    if (!empty($usepr) && $usepr) :    ?>

        <div class="recent portfolio row">

            <?php get_template_part('includes/portfolio-recent'); ?>

        </div>

        <?php endif ?>

    <!-- recent blog -->

    <?php

    $usebr = $data['iter_home_recent_posts_state'];

    if (!empty($usebr) && $usebr) :    ?>

        <div class="recent blog row">

            <?php get_template_part('includes/blog-recent'); ?>

        </div>

        <?php endif ?>

    <!-- slider -->

    <?php

    $usec = $data['iter_home_clients_state'];

    $slides = $data['iter_home_clients']; //get the slides array

    if (!empty($usec) && $usec) :    ?>

        <div class="clients row clearfix">

            <div class="twelvecol">

                <div class="line">

                    <div class="color">

                    </div>

                </div>

                <div class="title">

                    <h3 class="text home-section-title"><?php echo coll_first_word(__('Our Clients.', 'framework')); ?></h3>

                </div>

                <div class="logos">

                    <ul class="slides">

                        <?php foreach ($slides as $slide) { ?>

                        <li>

                            <?php if (!empty($slide['link'])) { ?>

                            <a href="<?php echo $slide['link']; ?>"><img src="<?php echo $slide['url']; ?>"/></a>

                            <?php } else { ?>

                            <img src="<?php echo $slide['url']; ?>"/>

                            <?php } ?>

                        </li>

                        <?php } ?>

                    </ul>

                </div>

            </div>

        </div>

        <?php endif ?>

</div>

<?php get_footer(); ?>