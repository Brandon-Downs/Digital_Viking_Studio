<?php 

	//Allow shortcodes to appear in widgets
	add_filter('widget_text', 'do_shortcode');
	
################################################################################
//	Shortcode: dateYear
//  Description: Prints the current year.
//	Usage: [dateYear]
################################################################################
	
	function dvs_theme_sc_foot_date($atts, $content = null) {
		return date('Y');
	}
	add_shortcode('dateYear', 'dvs_theme_foot_sc_date');
	
################################################################################
//	Shortcode: clear
//  Description: Creates a clearing div to organize content around floating 
//	images.
//	Usage: [clear]
################################################################################
	
	function dvs_theme_sc_clear_div($atts, $content = null) {
		return '<div class="clear"></div>';
	}
	add_shortcode('clear', 'dvs_theme_sc_clear_div');

################################################################################
// Add custom shortcodes here
################################################################################	
	// function moreButton($atts, $content = null) {
	// 	return '<div class="readMore">' . do_shortcode($content) . '</div>';
	// }
	// add_shortcode('button', 'moreButton');
	

	
	function dvs_theme_sc_big_btn($atts, $content = null) {
		extract(shortcode_atts(array(
			'link' => '#',
			'color' => 'green',
			'newtab' => 'no'
		), $atts));

		if ($newtab == 'yes'){
			$target = 'target="_blank"';
		}
		else $target = '';

		return '<a href="' . $link . '"
				 class="buttonCode button ' . $color . '"
				 ' . $target . '>' . $content . '</a>';
	}
	add_shortcode('button', 'dvs_theme_sc_big_btn');
	//Usage:
	//[button link="http://" newtab="yes"]Link Text[/button]


	function dvs_theme_sc_hr_div($atts, $content = null) {
		return '<div class="lineBreak"></div>';
	}
	add_shortcode('line', 'dvs_theme_sc_hr_div');
	//Usage:
	//[line]

?>