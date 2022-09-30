<?php



/*-----------------------------------------------------------------------------------



	Theme Shortcodes



-----------------------------------------------------------------------------------*/




/*-----------------------------------------------------------------------------------*/

/*	Column Shortcodes

/*-----------------------------------------------------------------------------------*/



function col_one_third( $atts, $content = null ) {

   return '<div class="one_third">' . do_shortcode($content) . '</div>';

}



add_shortcode('one_third', 'col_one_third');



function col_one_third_last( $atts, $content = null ) {

   return '<div class="one_third column-last">' . do_shortcode($content) . '</div><div class="clear"></div>';

}



add_shortcode('one_third_last', 'col_one_third_last');



function col_two_third( $atts, $content = null ) {

   return '<div class="two_third">' . do_shortcode($content) . '</div>';

}



add_shortcode('two_third', 'col_two_third');



function col_two_third_last( $atts, $content = null ) {

   return '<div class="two_third column-last">' . do_shortcode($content) . '</div><div class="clear"></div>';

}



add_shortcode('two_third_last', 'col_two_third_last');



function col_one_half( $atts, $content = null ) {

   return '<div class="one_half">' . do_shortcode($content) . '</div>';

}



add_shortcode('one_half', 'col_one_half');



function col_one_half_last( $atts, $content = null ) {

   return '<div class="one_half column-last">' . do_shortcode($content) . '</div><div class="clear"></div>';

}



add_shortcode('one_half_last', 'col_one_half_last');



function col_one_fourth( $atts, $content = null ) {

   return '<div class="one_fourth">' . do_shortcode($content) . '</div>';

}



add_shortcode('one_fourth', 'col_one_fourth');



function col_one_fourth_last( $atts, $content = null ) {

   return '<div class="one_fourth column-last">' . do_shortcode($content) . '</div><div class="clear"></div>';

}



add_shortcode('one_fourth_last', 'col_one_fourth_last');



function col_three_fourth( $atts, $content = null ) {

   return '<div class="three_fourth">' . do_shortcode($content) . '</div>';

}



add_shortcode('three_fourth', 'col_three_fourth');



function col_three_fourth_last( $atts, $content = null ) {

   return '<div class="three_fourth column-last">' . do_shortcode($content) . '</div><div class="clear"></div>';

}



add_shortcode('three_fourth_last', 'col_three_fourth_last');



function col_one_fifth( $atts, $content = null ) {

   return '<div class="one_fifth">' . do_shortcode($content) . '</div>';

}



add_shortcode('one_fifth', 'col_one_fifth');



function col_one_fifth_last( $atts, $content = null ) {

   return '<div class="one_fifth column-last">' . do_shortcode($content) . '</div><div class="clear"></div>';

}



add_shortcode('one_fifth_last', 'col_one_fifth_last');



function col_two_fifth( $atts, $content = null ) {

   return '<div class="two_fifth">' . do_shortcode($content) . '</div>';

}



add_shortcode('two_fifth', 'col_two_fifth');



function col_two_fifth_last( $atts, $content = null ) {

   return '<div class="two_fifth column-last">' . do_shortcode($content) . '</div><div class="clear"></div>';

}

add_shortcode('two_fifth_last', 'col_two_fifth_last');



function col_three_fifth( $atts, $content = null ) {

   return '<div class="three_fifth">' . do_shortcode($content) . '</div>';

}



add_shortcode('three_fifth', 'col_three_fifth');



function col_three_fifth_last( $atts, $content = null ) {

   return '<div class="three_fifth column-last">' . do_shortcode($content) . '</div><div class="clear"></div>';

}



add_shortcode('three_fifth_last', 'col_three_fifth_last');



function col_four_fifth( $atts, $content = null ) {

   return '<div class="four_fifth">' . do_shortcode($content) . '</div>';

}



add_shortcode('four_fifth', 'col_four_fifth');



function col_four_fifth_last( $atts, $content = null ) {

   return '<div class="four_fifth column-last">' . do_shortcode($content) . '</div><div class="clear"></div>';

}



add_shortcode('four_fifth_last', 'col_four_fifth_last');



function col_one_sixth( $atts, $content = null ) {

   return '<div class="one_sixth">' . do_shortcode($content) . '</div>';

}



add_shortcode('one_sixth', 'col_one_sixth');



function col_one_sixth_last( $atts, $content = null ) {

   return '<div class="one_sixth column-last">' . do_shortcode($content) . '</div><div class="clear"></div>';

}



add_shortcode('one_sixth_last', 'col_one_sixth_last');



function col_five_sixth( $atts, $content = null ) {

   return '<div class="five_sixth">' . do_shortcode($content) . '</div>';

}



add_shortcode('five_sixth', 'col_five_sixth');



function col_five_sixth_last( $atts, $content = null ) {

   return '<div class="five_sixth column-last">' . do_shortcode($content) . '</div><div class="clear"></div>';

}



add_shortcode('five_sixth_last', 'col_five_sixth_last');



function col_divider( $atts, $content = null ) {

   return '<div class="divider">' . do_shortcode($content) . '</div>';

}



add_shortcode('divider', 'col_divider');

/*-----------------------------------------------------------------------------------*/

/*	Buttons

/*-----------------------------------------------------------------------------------*/





function col_button( $atts, $content = null ) {



	extract(shortcode_atts(array(

		'url'     	 => '#',

		'target'     => '_self',

		'style'   => 'white'

    ), $atts));



   return '<a class="button '.$style.'" href="'.$url.'">' . do_shortcode($content) . '</a>';

}



add_shortcode('button', 'col_button');





/*-----------------------------------------------------------------------------------*/

/*	Alerts

/*-----------------------------------------------------------------------------------*/





function col_alert( $atts, $content = null ) {



	extract(shortcode_atts(array(

		'style'   => 'blue'

    ), $atts));



   return '<div class="alert '.$style.'">' . do_shortcode($content) . '</div>';

}



add_shortcode('alert', 'col_alert');





/*-----------------------------------------------------------------------------------*/

/*	Toggle Shortcodes

/*-----------------------------------------------------------------------------------*/



function col_toggle( $atts, $content = null ) {



    extract(shortcode_atts(array(

		'title'    	 => 'Title goes here',

		'state'		 => 'open'

    ), $atts));



	$out = '';



	$out .= "<div data-id='".$state."' class=\"toggle\"><h4>".$title."</h4><div class=\"toggle-inner\">".do_shortcode($content)."</div></div>";



    return $out;



}



add_shortcode('toggle', 'col_toggle');





/*-----------------------------------------------------------------------------------*/

/*	Tabs Shortcodes

/*-----------------------------------------------------------------------------------*/



if (!function_exists('col_tabs')) {

	function col_tabs( $atts, $content = null ) {

		$defaults = array();

		extract( shortcode_atts( $defaults, $atts ) );



		// Extract the tab titles for use in the tab widget.

		preg_match_all( '/tab title="([^\"]+)"/i', $content, $matches, PREG_OFFSET_CAPTURE );



		$tab_titles = array();

		if( isset($matches[1]) ){ $tab_titles = $matches[1]; }



		$output = '';



		if( count($tab_titles) ){

		    $output .= '<div id="tabs-'. rand(1, 100) .'" class="tabs"><div class="tab-inner">';

			$output .= '<ul class="nav clearfix">';



			foreach( $tab_titles as $tab ){

				$output .= '<li><a href="#tab-'. sanitize_title( $tab[0] ) .'">' . $tab[0] . '</a></li>';

			}



		    $output .= '</ul>';

		    $output .= do_shortcode( $content );

		    $output .= '</div></div>';

		} else {

			$output .= do_shortcode( $content );

		}



		return $output;

	}

	add_shortcode( 'tabs', 'col_tabs' );

}



if (!function_exists('col_tab')) {

	function col_tab( $atts, $content = null ) {

		$defaults = array( 'title' => 'Tab' );

		extract( shortcode_atts( $defaults, $atts ) );



		return '<div id="tab-'. sanitize_title( $title ) .'" class="tab">'. do_shortcode( $content ) .'</div>';

	}

	add_shortcode( 'tab', 'col_tab' );

}



//move wpautop filter to AFTER shortcode is processed

remove_filter( 'the_content', 'wpautop' );

add_filter( 'the_content', 'wpautop' , 99);

add_filter( 'the_content', 'shortcode_unautop',100 );

?>
