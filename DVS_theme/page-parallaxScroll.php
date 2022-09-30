<?php

/*

Template Name: Parallax Scroll

*/

?>

<?php get_header('plain'); ?>
<body onload="Init()">



<div class="base-wrapper">
	<div id="parallax" class="keyart">

		<div class="keyart_layer parallax" id="keyart-0" data-speed="88"><img src="<?php bloginfo('template_directory'); ?>/images/parallax/ityWaveBtm.png"></div>		<!-- 00.0 -->
		<div class="keyart_layer parallax" id="keyart-1" data-speed="20"><img src="<?php bloginfo('template_directory'); ?>/images/parallax/ityWaveMid.png"></div>	<!-- 12.5 -->

		<div class="keyart_layer parallax" data-speed="01">
			<h1 class="title">.ity</h1>
		</div>
		
		<div class="keyart_layer parallax" id="keyart-2" data-speed="30"><img src="<?php bloginfo('template_directory'); ?>/images/parallax/ityWaveTop.png"></div>		<!-- 25.0 -->


	</div>
		<div class="filler"></div>
	  
</div>




<?php get_footer(); ?> 