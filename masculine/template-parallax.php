<?php

/*

Template Name: Parallax

*/

?>

<?php get_header(); ?>
<body onload="Init()">

<div id="scene">
	<div data-depth="0.2"><span>My first Layer!</span></div>
	<div data-depth="0.6"><span>My second Layer!</span></div>
</div>


<script>
	let parallaxScene = document.getElementById('scene');
    let parallax = new Parallax(parallaxScene);
</script>



<?php get_footer(); ?>