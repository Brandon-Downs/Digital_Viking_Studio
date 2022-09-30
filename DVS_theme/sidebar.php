<?php 
global $post;
/**
*	Get Current page object
**/
$page = $wp_query->post;
$page_id = $page->ID;
?>
<div id="sidebar">

    <?php //List child pages of current page in the sidebar for appropriate pages
	$subpages = wp_list_pages('title_li=&child_of='.$page_id.'&echo=0&sort_column=menu_order&depth=1');
	if ($subpages && !is_archive() && !is_404() && !is_single() && !is_home()):
	?>
	
    <div class="subPageList">
		<?php echo '<nav id="subpages"><ul>' . str_replace('<a','&raquo; <a',$subpages) . '</ul></nav>'; ?>
	</div>
    
	<?php endif; ?>
    
	<?php if ( is_active_sidebar( 'primary-sidebar' ) ) : ?>
	
		<?php if ( function_exists('dynamic_sidebar') ) dynamic_sidebar( 'primary-sidebar' ); ?>
	
	<?php endif; ?>
    
</div><!-- /#sidebar -->