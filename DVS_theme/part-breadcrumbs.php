<?php if ( is_page() && $post->post_parent ) { ?>
	<div class="breadCrumb">
        <?php if ( function_exists('yoast_breadcrumb') ) {
        	yoast_breadcrumb('<p id="breadcrumb">','</p>');
        } ?>
    </div>
<?php } ?>