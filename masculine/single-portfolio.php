<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<div class="title container">
    <div class="row">
        <div class="twelvecol">
            <h1 class='text'><?php the_title(); ?></h1>

            <div class="oline">
                <canvas id="mycanvas"></canvas>
            </div>
            <div class="portfolio navigation big">
                <?php if (get_previous_post()) : ?>
                <div class="previous">
                    <?php $prev_post_id = get_previous_post()->ID;
                    echo "<a class='' title='" . get_previous_post()->post_title . "' href='" . get_permalink($prev_post_id) . "'><span class='bnp'></span></a>"
                    ?>
                </div>
                <?php endif; ?>
                <?php if (get_next_post()) : ?>
                <div class="next">
                    <?php $next_post_id = get_next_post()->ID;
                    echo "<a class='' title='" . get_next_post()->post_title . "' href='" . get_permalink($next_post_id) . "'><span class='bnp'></span></a>"
                    ?>
                </div>
                <?php endif; ?>


            </div>
        </div>
    </div>
</div>

<div id="main" class="content container clearfix">
    <div class="row">

        <div class="entry-meta threecol">
            <ul>
                <?php $client = get_post_meta(get_the_ID(), 'client', true); ?>
                <?php if (!empty($client)) : ?>
                <li class="client">
                    <label><?php _e('Client: ', 'framework');  ?></label>
                    <span><?php echo $client ?></span>
                </li>
                <?php endif; ?>
                <?php  $date = get_post_meta(get_the_ID(), 'date', true); ?>
                <?php if (!empty($date)) : ?>
                <li class="date">
                    <label><?php _e('Date: ', 'framework');  ?></label>
                    <span><?php echo $date ?> </span>
                </li>
                <?php endif; ?>
                <?php $lproj = get_post_meta(get_the_ID(), 'url', true);
                if (!empty($lproj)) :
                    ?>
                    <li class="launch">
                        <a href="<?php echo get_post_meta(get_the_ID(), 'url', true); ?>"
                           class="superlink"
                           title="<?php echo get_post_meta(get_the_ID(), 'url', true); ?>">
                            <?php _e('Launch Project', 'framework'); ?>
                        </a>
                    </li>
                    <?php endif; ?>

            </ul>
        </div>
        <div class="entry-content ninecol last">
            <?php the_content(); ?>
        </div>

    </div>
    <div class="row">
        <div class="assets twelvecol">
            <?php
            $pi_data = get_port_item_content(get_the_ID());
            $n = 0;
            if ($pi_data) {
                foreach ($pi_data as $content_info) {
                    switch ($content_info->type) {
                        case "image":
                            ?>
                                <div class="item image"><a href="<?php echo $content_info->url?>"
                                                           rel="pp[gall]"><img
                                    src="<?php echo $content_info->url?>"/></a></div>
                                <?php
                            break;
                        case "youtube":
                            //check to see if the video has any options, the ? sign
                            $has = strstr($content_info->url, "?");

                            if (!$has) {
                                $embed = explode('"', $content_info->url);
                                // insert enablejsapi option
                                $embed[5] .= "?wmode=transparent";
                                $embed = implode('"', $embed);
                            } else {
                                // insert enablejsapi option
                                $embed = str_ireplace("&", "&amp;", $content_info->url);
                                $embed = str_ireplace("?", "?wmode=transparent&amp;", $embed);
                            }

                            // get original dimensions
                            $pattern = "/height=\"[0-9]*\"/";
                            preg_match($pattern, $embed, $matches);
                            $origHeight = preg_replace("/[^0-9]/", '', $matches[0]);

                            // compute new height
                            //$newHeight = $origHeight + 25;
                            $newHeight = $origHeight;

                            // adjust embed code
                            $pattern = "/height=\"[0-9]*\"/";
                            $embed = preg_replace($pattern, "height='" . $newHeight . "'", $embed);

                            // insert an id for the iframe
                            $id = '<iframe id="ytplayer' . $n . '" ';
                            $embed = str_ireplace("<iframe ", $id, $embed);
                            ?>
                                <div class="item youtube fitvid"><?php  echo $embed?></div>
                                <?php
                            break;
                        case "vimeo":
                            $embed = $content_info->url;
                            ?>
                                <div class="item vimeo fitvid"><?php  echo $embed?></div>
                                <?php
                            break;
                        case "video":
                            $w = $content_info->width;
                            $h = $content_info->height;
                            $tmb = $content_info->tmb;
                            $m4v = $content_info->m4v;
                            $ogv = $content_info->ogv;
                            ?>

                                <div class="item video">
                                    <?php   insert_video($n, $w, $h, $tmb, $m4v, $ogv); ?>
                                    <div id="jquery_jplayer_<?php echo $n ?>"
                                         class="jp-jplayer jp-jplayer-video"
                                         style="width:<?php echo $w; ?>px; height:<?php echo $h; ?>px;"></div>
                                    <div class="jp-video-container">
                                        <div class="jp-video">
                                            <div class="jp-type-single">
                                                <div id="jp_interface_<?php echo $n?>" class="jp-interface">
                                                    <ul class="jp-controls">
                                                        <li>
                                                            <div class="seperator-first"></div>
                                                        </li>
                                                        <li>
                                                            <div class="seperator-second"></div>
                                                        </li>
                                                        <li><a href="#" class="jp-play" tabindex="1">play</a>
                                                        </li>
                                                        <li><a href="#" class="jp-pause" tabindex="1">pause</a>
                                                        </li>
                                                        <li><a href="#" class="jp-mute" tabindex="1">mute</a>
                                                        </li>
                                                        <li><a href="#" class="jp-unmute"
                                                               tabindex="1">unmute</a>
                                                        </li>
                                                    </ul>
                                                    <div class="jp-progress-container">
                                                        <div class="jp-progress">
                                                            <div class="jp-seek-bar">
                                                                <div class="jp-play-bar"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="jp-volume-bar-container">
                                                        <div class="jp-volume-bar">
                                                            <div class="jp-volume-bar-value"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php break;
                    }
                    //end switch
                    $n++;
                } //end for each
            }//end if
            ?>


        </div>
        <!-- END assets-->
        <?php
        $userp = $data['iter_portfolio_single_related_state'];
        if (!empty($userp) && $userp) :    ?>
            <div class="related recent twelvecol">
                <?php get_template_part('includes/portfolio-related-projects'); ?>
            </div>
            <?php endif; ?>
    </div>
</div>
<?php endwhile; endif; ?>


<?php get_footer(); ?>
