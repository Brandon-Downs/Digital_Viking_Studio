
	
	<footer id="footer">
		<div class="container">
			
			<?php if(has_nav_menu('footer_menu')): ?>
				<?php wp_nav_menu(array('theme_location' => 'footer_menu', 'menu_class' => 'menu cf')); ?>
			<?php endif; ?>
			
			<div class="clear">
				<div class="footLeft">
					<?php if(is_active_sidebar('copyright')): ?>
					<div class="copyright"><?php dynamic_sidebar('copyright'); ?></div><!-- /.copyright -->
					<?php endif; ?>
				</div><!-- /.left -->
				
				
	                
			</div><!-- /.clear -->

		</div>
	</footer>	

	<?php wp_footer(); ?>
</body>
</html>