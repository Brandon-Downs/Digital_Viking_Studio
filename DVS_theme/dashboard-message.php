<?php if( !defined( 'ABSPATH' ) ) die(); // direct access guard

$fmt_val = false;?>

<p style="text-align: center;">
	<img class="aligncenter" src="<?php bloginfo('template_directory'); ?>/images/dvs_logo_square_150.png" alt="" width="120" height="120" style="margin:0 auto 5px;" />
</p>

<p style="font-size:16px;line-height:22px;text-align:center;"><strong>Hello <?php esc_html_e( get_bloginfo( 'name' ) ); ?>!</strong></br>Here are some notes to help you with your use of this website:</p>

<?php
while( have_rows( 'dvs_admin_notes', 'option' ) ): the_row(); ?>

	<div class="dvsDashboardWrap">

		<?php if( !empty( get_sub_field( 'title' ) ) ): ?>
			<h3 style="font-size:18px;line-height:22px;font-weight:bold;"><?php esc_html_e( get_sub_field( 'title' ) ); ?></h3>
		<?php endif; ?>

		<?php if( !empty( get_sub_field( 'content' ) ) ): ?>
			<?php echo wp_kses_post( dvs_theme_strip_html_comments( get_sub_field( 'content', $fmt_val ) ) ); ?>
		<?php endif; ?>

	</div>

<?php endwhile; ?>