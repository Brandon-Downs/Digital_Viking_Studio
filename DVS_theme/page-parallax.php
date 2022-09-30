<?php

/*

Template Name: Parallax

*/

?>

<?php get_header(); ?>
<body onload="Init()">

<div class="container">
	<img class="logo" src="<?php bloginfo('template_directory'); ?>/images/dvs_logo_square_150.png" alt="logo">
</div>

<div class="parawrapper">
	<div class="ratioKeeper"></div>
	<div class="container">
		<div id="scene">

			<div class="layer mountains" data-depth="0.0"></div>

			<div class="layer mist back" data-depth="0.1"><img src="<?php bloginfo('template_directory'); ?>/images/parallax/6_back_mist.PNG"></div>
			
			<div class="layer ships" data-depth="0.2" data-scalar-x="50.0"><img src="<?php bloginfo('template_directory'); ?>/images/parallax/5_back_ships.PNG"></div>

			<div class="layer mist" data-depth="0.1"><img src="<?php bloginfo('template_directory'); ?>/images/parallax/6_back_mist.PNG"></div>

			<div class="layer ships front" data-depth="0.3"><img src="<?php bloginfo('template_directory'); ?>/images/parallax/4_back_ships.PNG"></div>
			
			<div class="layer walkBack" data-depth="0.5"><img src="<?php bloginfo('template_directory'); ?>/images/parallax/3_walk_back.PNG"></div>

			<div class="layer walkFront" data-depth="0.7"><img src="<?php bloginfo('template_directory'); ?>/images/parallax/3_walk_front.PNG"></div>

			<div class="layer hills" data-depth="0.75"><img src="<?php bloginfo('template_directory'); ?>/images/parallax/2_close_hills.PNG"></div>

			<div class="layer tree" data-depth="1.9"><img src="<?php bloginfo('template_directory'); ?>/images/parallax/1_close_R.PNG"></div>

			<div class="layer tree" data-depth="2.0"><img src="<?php bloginfo('template_directory'); ?>/images/parallax/1_close_L.PNG"></div> 

		</div>
	</div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/parallax/3.1.0/parallax.min.js"></script>
<!-- <script src="js/src/vendor/parallax.min.js"></script> -->
<script>
	var scene = document.getElementById('scene');
    var parallax = new Parallax(scene, {
		relativeInput: true,
		clipRelativeInput: true,
 		hoverOnly: true,
 		scalarY: '1.5',
	});
</script>



<?php get_footer(); ?> 