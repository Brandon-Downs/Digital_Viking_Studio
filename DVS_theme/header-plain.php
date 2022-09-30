<!DOCTYPE html>

<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">

	<title><?php bloginfo('name'); ?><?php wp_title( '|', true, 'left' ); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<?php if ( file_exists(TEMPLATEPATH .'/favicon.ico') ) : ?>
		<link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/favicon.ico">
	<?php endif; ?>

	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/src/vendor/firewizard.js"></script>

	<?php wp_head(); ?>

</head>

<?php $body_classes = join( ' ', get_body_class() ); ?>
<body class="imPlain <?php esc_attr_e( $body_classes ); ?>">