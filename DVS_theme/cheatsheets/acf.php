<?php 


//Advanced Custom Fields Cheatsheet
//This file is intended to be a quick reference. For fully detailed documentation, you should refer to the acf documentation: http://www.advancedcustomfields.com/resources/

                                <div class="social-links">
    
                                    <?php if(get_field("twitter_link")): ?>
                                        <a href="<?php the_field("twitter_link"); ?>" class="twitter_link">
                                        
                                        </a>
                                    <?php endif; ?>
                                    <?php if(get_field("linkedin")): ?>
                                        <a href="<?php the_field("linkedin"); ?>" class="linkedIn_link">
                                       
                                        </a>
                                    <?php endif; ?>
                                    <?php if(get_field("facebook_link")): ?>
                                        <a href="<?php the_field("facebook_link"); ?>" class="facebook_link">
                                        
                                        </a>
                                    <?php endif; ?>
                                    
                                </div><!-- /.socialPersonLinks -->

/*********************************************************************************************************************************** GENERAL ***/

/*	Descripiton: This funciton will print a custom field to the screen
**	NOTE: Must be used inside "the loop"
**
	the_field("field-slug");
**
*/

/*	Descripiton: This funciton will store a custom field in a variable
**	NOTE: Must be used inside "the loop"
**
	$myField = get_field("field-slug");
**
*/


/*********************************************************************************************************************************** OUTSIDE THE LOOP ***/

/*	Descripiton: This funciton will print a custom field to the screen
**	NOTE: Must be used inside "the loop"
**
	the_field("field-slug");
**
*/

/*	Descripiton: This funciton will store a custom field in a variable
**	NOTE: Must be used inside "the loop"
**
	$myField = get_field("field-slug");
**
********************************************************************************************************************
Example content

Image Field - Use "Image Object" 

	<?php if(get_field('featured_event_image')): ?>
	<a href="<?php the_permalink(); ?>"><?php echo wp_get_attachment_image(get_field('featured_event_image'),'featSponsor', array('title' => get_the_title())); ?></a>
            

Styles in header looking at image in options
// Uses Image ID
<style type="text/css">
	#main-nav #menu-item-20 ul {
		/*
		background:#FFF url('<?php echo wp_get_attachment_image(get_field('first_dropdown_image'),'research-area'),  'options'; ?>') no-repeat left top;
		*/
		
		<?php if($bg_img): ?>
			background:#FFF url('<?php echo $bg_img[0]; ?>') no-repeat 10px 15px;
			
		<?php else: ?>
			/* background: url('<?php bloginfo('template_url'); ?>/images/bg_page3.jpg') no-repeat; */

		<?php endif; ?>

	}

</style>







        <div class="theContent">
            <?php 
			wp_reset_query();
			the_content(); 
			?>
        </div>
        
        <?php global $post;
            $staff = get_posts(array(
                'post_type' => 'staff',
				'posts_per_page'  => -1,
                'post_status' => 'publish',
                'orderby' => 'menu_order',
				'order' => 'ASC',
				'tax_query' => array(array(
					'taxonomy' => 'association',
					'field' => 'id',
					'terms' => 34
				))
            ));
        ?>
        
        <?php if ($staff) : ?>
        	<section class="staffList cf">
		    <?php foreach ($staff as $post) : setup_postdata($post); ?>
				<?php 
                $name = get_field('member_name');
                $position = get_field('position');
                $extension = get_field('extension');
                $company_name = get_field('external_link_name');
                $company_link = get_field('external_link');
                $email = get_field('email');
                $linkedin = get_field('linkedin');
                ?>
                
                <article class="staffMember cf" id="post-<?php the_ID(); ?>">
                    <?php if(has_post_thumbnail()): ?>
                        <?php the_post_thumbnail('thumbnail', array('class' => 'alignleft')); ?>
                    <?php endif; ?>
                    
                    <p class="name"><strong><?php the_title(); ?></strong></p>
                    
                    <?php if($company_name): ?>
                        <p class="details"> of
                            <?php if($company_link): ?>
                                <a href="<?php echo $company_link; ?>" target="_blank">
                            <?php endif; ?>
                            
                                <?php echo $company_name; ?>
                            
                            <?php if($company_link): ?>
                                </a>
                            <?php endif; ?>
                        </p>
                    <?php endif; ?>
                    
                    <?php if($position): ?>
                    <p class="details"><?php echo $position; ?></p>
                    <?php endif; ?>
                    
                    <?php if($extension): ?>
                    <p class="details">Extension Number: <?php echo $extension; ?></p>
                    <?php endif; ?>
                    
                    <?php if($email): ?>
                    <p class="details">Email: <a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></p>
                    <?php endif; ?>
                    
                    <?php if($linkedin): ?>
                    <p class="details"><a href="<?php echo $linkedin; ?>">Visit me on LinkedIn.com<?php //echo $linkedin; ?></a></p>
                    <?php endif; ?>
                </article>
                
            <?php endforeach; ?>
        </section><!-- /.staffList -->
        <?php endif; ?>



*/

?>