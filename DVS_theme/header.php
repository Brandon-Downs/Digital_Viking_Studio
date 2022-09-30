<!DOCTYPE html>

<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">

	<title><?php wp_title( '|', true, 'right' ); ?><?php bloginfo('name'); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<?php if ( file_exists(TEMPLATEPATH .'/favicon.ico') ) : ?>
		<link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/favicon.ico">
	<?php endif; ?>

	<?php if ( file_exists(TEMPLATEPATH .'/apple-touch-icon.png') ) : ?>
		<link rel="apple-touch-icon" href="<?php bloginfo('template_url'); ?>/apple-touch-icon.png">
	<?php endif; ?>

	<?php wp_head(); ?>

</head>

<?php $body_classes = join( ' ', get_body_class() ); ?>
<body class="<?php esc_attr_e( $body_classes ); ?>">

<header id="header" class="cf">
	<div class="container">
    	<?php $front_pg = get_option('page_on_front'); //Grab the ID of the current page set to the front ?>

		<div id="logo">

	    	<?php
	    	$image = get_field('logo', 'options');

	    	if($image):

			    $url = $image['url'];
			    $title = $image['title'];
			    $alt = $image['alt'];


			    $size = 'medSq';
			    $thumb = $image['sizes'][ $size ];  ?>

			    <a href="<?php bloginfo('url'); ?>/">
			        <img src="<?php echo esc_url($thumb); ?>" alt="<?php echo esc_attr($alt); ?>" />
			    </a>

		    <?php else: ?>

				<a href="<?php bloginfo('url'); ?>/" class="site-title clear"><?php bloginfo('name'); ?></a>
		    	
			<?php 
			endif;
			?>
        
		</div>

	</div>
</header>
    
<nav id="main-nav">
    <div class="container">
		<?php wp_nav_menu(array( 
			'container_class' => 'menu-header', 
			'theme_location' => 'primary', 
			'menu_class' => 'menu cf'
		)); ?>
	</div>
</nav>
        
<div id="main" class="cf">
    