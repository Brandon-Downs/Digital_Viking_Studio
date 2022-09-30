<?php 
//WP Query CheatSheet

//Select posts randomly and display randomly

	'orderby' => 'rand',
	'order' => 'ASC',

/************************************************** CUSTOM POST TYPES ********************************************************************************/

/* NAME: Custom Post Type - Ordered by Menu Order
** Descripiton: This will get all published instances of a custom post type, ordered by the user 
** on the backend of WP and let you loop through and display them.
**
		<?php
		//This is the query
		global $post;
		
		$cpt_slug = 'custom_post_type_slug'; //Replace custom_post_type_slug with your custom post type's slug
		$objects = get_posts(array(
			'post_type' => $cpt_slug,
			'post_status' => 'publish',
			'orderby' => 'menu_order',
			'order' => 'ASC',
			'posts_per_page' => -1
		));
		
		//Check if any posts were found
		if($objects): ?>
			<div class="customLoop">
				<?php
				//Loop through the posts
				foreach($objects as $post): setup_postdata($post);
				?>
					<div <?php post_class(); ?>>
						
						<?php if(has_post_thumbnail()): ?>                                          
							<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
						<?php endif; ?>

						<?php echo wp_get_attachment_image(get_field('image'), 'img-size'); ?>
						<!-- Must set image as "ID" in custom fields. -->

						<h3><?php the_title(); ?></h3>
						
						<?php if(get_field('fieldname')): ?>                                   
							<?php the_field('fieldname'); ?>
						<?php endif; ?>		

						<?php if(get_field('condition_name')): ?>                                   
						Email: <a href="mailto:<?php the_field('condition_name'); ?>"></a>
						<?php endif; ?>				
						
						<div class="exWrap">
							<?php the_excerpt(); ?>
						</div>

					</div><!-- /.post -->
				<?php
				endforeach; ?>
			</div>

			<?php
			//These are important so that the rest of your page will load properly after using this function
			wp_reset_postdata();
			wp_reset_query();
			?>
		<?php endif; ?>
**
*/



/************************************************** GENERAL ********************************************************************************/

/* NAME: Single Post/Page/Custom Post Type by ID
** Descripiton: This will get a single post/page/post type by id and let you use tbe familiar WP loop functions to display it.
**
	$post_id = 14; //Replace 14 with your post/page/post type id
	$myPost = ready_post($post_id); //The function
	
	//Here we make sure that a post was actually found
	if($myPost){
		if(has_post_thumbnail()){                                                                            
			the_post_thumbnail(); 
		} 
		the_title();
		the_content('Read More');
		
		//These are important so that the rest of your page will load properly after using this function
		wp_reset_postdata();
		wp_reset_query();
	}
**
*/



/* NAME: Published Posts - Ordered Newest to Oldest
** Descripiton: This will get all published 'posts', ordered newest to oldest 
** and let you loop through and display them.
**
	<?php
		//This is the query
		global $post;
		$all_posts = get_posts(array(
			'post_type' => 'post',
			'post_status' => 'publish',
			'orderby' => 'post_date',
			'order' => 'DESC',
			'posts_per_page' => -1
		));
		
		//Check if any posts were found
		if($all_posts):
			//Loop through the posts
			foreach($all_posts as $post): setup_postdata($post);
	?>
				<div <?php post_class(); ?>>
					<?php if(has_post_thumbnail()): ?>                                          
						<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
					<?php endif; ?>
					
					the_title();
					the_excerpt();
				</div><!-- /.post -->
	<?php
			endforeach;
	
			//These are important so that the rest of your page will load properly after using this function
			wp_reset_postdata();
			wp_reset_query();
		endif;
	?>
**
*/



/************************************************** CATEGORIES ********************************************************************************/

/* NAME: All Published Posts with a certain Category(includes category children) by ID - Ordered Newest to Oldest
** Descripiton: This will get all published 'posts' in a certain category(including that category's child categories) using the Categoty ID, 
** ordered newest to oldest and let you loop through and display them.
**
	<?php
		
		//This is the query
		global $post;
		
		$category_id = 14; //Replace 14 with your category id
		$all_posts = get_posts(array(
			'post_type' => 'post',
			'post_status' => 'publish',
			'cat' => $category_id,
			'orderby' => 'post_date',
			'order' => 'DESC',
			'posts_per_page' => -1
		));
		
		//Check if any posts were found
		if($all_posts):
			//Loop through the posts
			foreach($all_posts as $post): setup_postdata($post);
	?>
				<div <?php post_class(); ?>>
					<?php if(has_post_thumbnail()): ?>                                          
						<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
					<?php endif; ?>
					
					the_title();
					the_excerpt();
				</div><!-- /.post -->
	<?php
			endforeach;
	
			//These are important so that the rest of your page will load properly after using this function
			wp_reset_postdata();
			wp_reset_query();
		endif;
	?>
**
*/



/* NAME: All Published Posts with a certain Category(includes category children) by Slug - Ordered Newest to Oldest
** Descripiton: This will get all published 'posts' in a certain category(including that category's child categories) using the Category Slug, 
** ordered newest to oldest and let you loop through and display them.
**
	<?php
		//This is the query
		global $post;
		
		$category_slug = 'cat_slug'; //Replace cat_slug with your category slug
		$all_posts = get_posts(array(
			'post_type' => 'post',
			'post_status' => 'publish',
			'category_name' => $category_slug,
			'orderby' => 'post_date',
			'order' => 'DESC',
			'posts_per_page' => -1
		));
		
		//Check if any posts were found
		if($all_posts):
			//Loop through the posts
			foreach($all_posts as $post): setup_postdata($post);
	?>
				<div <?php post_class(); ?>>
					<?php if(has_post_thumbnail()): ?>                                          
						<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
					<?php endif; ?>
					
					the_title();
					the_excerpt();
				</div><!-- /.post -->
	<?php
			endforeach;
	
			//These are important so that the rest of your page will load properly after using this function
			wp_reset_postdata();
			wp_reset_query();
		endif;
	?>
**
*/



/* NAME: All Published Posts with a certain Category/Categories(not including category children) - Ordered Newest to Oldest
** Descripiton: This will get all published 'posts' in a certain category/categories(not including the category's child categories), 
** ordered newest to oldest and let you loop through and display them. 
** 
	<?php
		//This is the query
		global $post;
		
		$category_list = array(14, 16); //Replace 14 and 16 with your category ids - You can use only one id if you want but it must still be passed as an array.
		$all_posts = get_posts(array(
			'post_type' => 'post',
			'post_status' => 'publish',
			'category__in' => $category_list,
			'orderby' => 'post_date',
			'order' => 'DESC',
			'posts_per_page' => -1
		));
		
		//Check if any posts were found
		if($all_posts):
			//Loop through the posts
			foreach($all_posts as $post): setup_postdata($post);
	?>
				<div <?php post_class(); ?>>
					<?php if(has_post_thumbnail()): ?>                                          
						<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
					<?php endif; ?>
					
					the_title();
					the_excerpt();
				</div><!-- /.post -->
	<?php
			endforeach;
	
			//These are important so that the rest of your page will load properly after using this function
			wp_reset_postdata();
			wp_reset_query();
		endif;
	?>
**
*/



/************************************************** TAGS ********************************************************************************/

/* NAME: All Published Posts with a certain Tag by ID - Ordered Newest to Oldest
** Descripiton: This will get all published 'posts' with a certain Tag, 
** ordered newest to oldest and let you loop through and display them.
**
	<?php
		//This is the query
		global $post;
		
		$tag_id = 14; //Replace 14 with your tag's id
		$all_posts = get_posts(array(
			'post_type' => 'post',
			'post_status' => 'publish',
			'tag_id' => $tag_id,
			'orderby' => 'post_date',
			'order' => 'DESC',
			'posts_per_page' => -1
		));
		
		//Check if any posts were found
		if($all_posts):
			//Loop through the posts
			foreach($all_posts as $post): setup_postdata($post);
	?>
				<div <?php post_class(); ?>>
					<?php if(has_post_thumbnail()): ?>                                          
						<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
					<?php endif; ?>
					
					the_title();
					the_excerpt();
				</div><!-- /.post -->
	<?php
			endforeach;
	
			//These are important so that the rest of your page will load properly after using this function
			wp_reset_postdata();
			wp_reset_query();
		endif;
	?>
**
*/



/* NAME: All Published Posts with a certain Tag by Slug - Ordered Newest to Oldest
** Descripiton: This will get all published 'posts' with a certain Tag by the Slug, 
** ordered newest to oldest and let you loop through and display them.
**
	<?php
		//This is the query
		global $post;
		
		$tag_slug = 'tag_slug'; //Replace tag_slug with your tag's slug.
		$all_posts = get_posts(array(
			'post_type' => 'post',
			'post_status' => 'publish',
			'tag' => $tag_slug,
			'orderby' => 'post_date',
			'order' => 'DESC',
			'posts_per_page' => -1
		));
		
		//Check if any posts were found
		if($all_posts):
			//Loop through the posts
			foreach($all_posts as $post): setup_postdata($post);
	?>
				<div <?php post_class(); ?>>
					<?php if(has_post_thumbnail()): ?>                                          
						<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
					<?php endif; ?>
					
					the_title();
					the_excerpt();
				</div><!-- /.post -->
	<?php
			endforeach;
	
			//These are important so that the rest of your page will load properly after using this function
			wp_reset_postdata();
			wp_reset_query();
		endif;
	?>
**
*/



/************************************************** CUSTOM TAXONOMIES ********************************************************************************/

/* NAME: Custom Post Type w/ Custom Taxonomy Term(s) - Ordered by Menu Order
** Descripiton: This will get all published instances of a custom post type which has 
** a certain custom taxonomy term or set of taxonomy terms - ordered by the user on the backend of WP and let you loop through and display them.
**
** More Info: http://codex.wordpress.org/Class_Reference/WP_Query#Taxonomy_Parameters
**
	<?php
		//This is the query
		global $post;
		
		$cpt_slug = 'custom_post_type_slug'; //Replace custom_post_type_slug with your custom post type's slug
		$tax_slug = 'taxonomy_slug'; //Replace taxonomy_slug with your custom taxonomy's slug
		$term_id = 14; //Replace 14 with your custom term's id OR for multiple ids use: array(14, 15, 16);
		
		$objects = get_posts(array(
			'post_type' => $cpt_slug,
			'post_status' => 'publish',
			'orderby' => 'menu_order',
			'order' => 'ASC',
			'tax_query' => array(
				array(
					'taxonomy' => $tax_slug,
					'field' => 'id', //change this to 'slug' to use term slugs instead of ids below
					'terms' => $term_id
				),
				//If you want to filter by more than one taxonomy you can just add another array and follow the same rules as above:
				array(
					'taxonomy' => $tax_slug_2,
					'field' => 'id', //change this to 'slug' to use slugs instead of ids below
					'terms' => $term_id_2
				)
			),
			'posts_per_page' => -1
		));
		
		//Check if any posts were found
		if($objects):
			//Loop through the posts
			foreach($objects as $post): setup_postdata($post);
	?>
				<div <?php post_class(); ?>>
					<?php if(has_post_thumbnail()): ?>                                          
						<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
					<?php endif; ?>
					
					the_title();
					the_excerpt();
				</div><!-- /.post -->
	<?php
			endforeach;
			
			//These are important so that the rest of your page will load properly after using this function
			wp_reset_postdata();
			wp_reset_query();
		endif;
	?>
**
*/

/* NAME: Custom Post Type displayed under Custom Taxonomy Term(s): Subcategories NOT included - Ordered by Menu Order and Taxonomy Term Order
** Descripiton: This will get all published instances of a custom post type grouped and displayed by taxonomy terms 
** and ordered by menu order and taxonomy term order. This will ignore sub-categoried and list all objects in a child term under the parent term.
**
** More Info: http://codex.wordpress.org/Class_Reference/WP_Query#Taxonomy_Parameters
**
	<?php 
	$post_type_name = 'staff'; //Your CPT slug goes here
	$taxonomy_name = 'association'; //Your custom taxonomy slug goes here
	
	$all_objects = get_posts(array(
		'post_type' => $post_type_name,
		'post_status' => 'publish',
		'posts_per_page' => -1
	)); 
	?>
	<?php if($all_objects): ?>
		<?php 
		$terms = get_terms( $taxonomy_name, array(
			'orderby' => 'term_order',
			'hide_empty' => true,
			'parent' => 0 //only top level cats
		)); 
		?>
		
		<?php foreach($terms as $curr_cat): ?>
			<?php 
				$curr_cat_id = $curr_cat->term_id;
				$curr_cat_name = $curr_cat->name;
				
				$sub_cats = get_terms($taxonomy_name, array(
					'orderby' => 'term_order',
					'hide_empty' => true,
					'child_of' => $curr_cat_id
				)); 
			?>
			
			<?php
				$objects = get_posts(array(
					'post_type' => $post_type_name,
					'post_status' => 'publish',
					'orderby' => 'menu_order',
					'order' => 'ASC',
					'tax_query' => array(array(
						'taxonomy' => $taxonomy_name,
						'field' => 'id',
						'terms' => $curr_cat_id
					)),
					'posts_per_page' => -1
				));
			?>
			
			<?php if($objects): ?>
				<h2><?php echo $curr_cat_name; ?></h2>
				<section class="cf">
					<?php foreach($objects as $post): setup_postdata($post); ?>

						<article <?php post_class('cf') ?> id="post-<?php the_ID(); ?>">
							<header>
								<h4><?php the_title(); ?></h4>
							</header>
							
							<?php if(has_post_thumbnail()): ?>
								<a href="<?php echo wp_get_attachment_url(get_post_thumbnail_id()); ?>"><?php the_post_thumbnail('thumbnail', array('class' => 'alignleft', 'title' => get_the_title())); ?></a>
							<?php endif; ?>

							<?php the_excerpt(); ?>
						</article>

					<?php endforeach; //$objects ?>
					<?php wp_reset_postdata(); ?>
					<?php wp_reset_query(); ?>
				</section><!-- /. -->
			<?php endif; //$objects ?>
			
		<?php endforeach; //$terms ?>
	<?php endif; //$all_objects ?>
*/

/* NAME: Custom Post Type displayed under Custom Taxonomy Term(s): Subcategories included - Ordered by Menu Order and Taxonomy Term Order
** Descripiton: This will get all published instances of a custom post type grouped and displayed by taxonomy terms 
** and ordered by menu order and taxonomy term order.
**
** More Info: http://codex.wordpress.org/Class_Reference/WP_Query#Taxonomy_Parameters
**
	<?php 
	$post_type_name = 'staff'; //Your CPT slug goes here
	$taxonomy_name = 'association'; //Your custom taxonomy slug goes here
	
	$all_objects = get_posts(array(
		'post_type' => $post_type_name,
		'post_status' => 'publish',
		'posts_per_page' => -1
	)); 
	?>
	<?php if($all_objects): ?>
		<?php 
		$terms = get_terms( $taxonomy_name, array(
			'orderby' => 'term_order',
			'hide_empty' => true,
			'parent' => 0 //only top level cats
		)); 
		?>
		
		<?php foreach($terms as $curr_cat): ?>
			<?php 
				$curr_cat_id = $curr_cat->term_id;
				$curr_cat_name = $curr_cat->name;
				
				$sub_cats = get_terms($taxonomy_name, array(
					'orderby' => 'term_order',
					'hide_empty' => true,
					'child_of' => $curr_cat_id
				)); 
			?>
			
			<?php
				$objects = get_posts(array(
					'post_type' => $post_type_name,
					'post_status' => 'publish',
					'orderby' => 'menu_order',
					'order' => 'ASC',
					'tax_query' => array(array(
						'taxonomy' => $taxonomy_name,
						'field' => 'id',
						'terms' => $curr_cat_id,
						'include_children' => false
					)),
					'posts_per_page' => -1
				));
			?>
			
			<?php if($objects): ?>
				<h2><?php echo $curr_cat_name; ?></h2>
				<section class="cf">
					<?php foreach($objects as $post): setup_postdata($post); ?>

						<article <?php post_class('cf') ?> id="post-<?php the_ID(); ?>">
							<header>
								<h4><?php the_title(); ?></h4>
							</header>
							
							<?php if(has_post_thumbnail()): ?>
								<a href="<?php echo wp_get_attachment_url(get_post_thumbnail_id()); ?>"><?php the_post_thumbnail('thumbnail', array('class' => 'alignleft', 'title' => get_the_title())); ?></a>
							<?php endif; ?>

							<?php the_excerpt(); ?>
						</article>

					<?php endforeach; //$objects ?>
					<?php wp_reset_postdata(); ?>
					<?php wp_reset_query(); ?>
				</section><!-- /. -->
			<?php endif; //$objects ?>
			
			<?php //Subcategories ?>
			<?php if($sub_cats): ?>
				<?php foreach($sub_cats as $sub_cat): ?>
					<?php
					$sub_cat_id = $sub_cat->term_id;
					$sub_cat_name = $sub_cat->name;
					?>
					
					<?php 
						$objects = get_posts(array(
							'post_type' => $post_type_name,
							'post_status' => 'publish',
							'orderby' => 'menu_order',
							'order' => 'ASC',
							'tax_query' => array(array(
								'taxonomy' => $taxonomy_name,
								'field' => 'id',
								'terms' => $sub_cat_id,
								'include_children' => false
							)),
							'posts_per_page' => -1
						));
					?>
					
					<?php if($objects): ?>
						<h3><?php echo $sub_cat_name; ?></h3>
						<section class="cf">
							<?php foreach($objects as $post): setup_postdata($post); ?>
	
								<article <?php post_class('cf') ?> id="post-<?php the_ID(); ?>">
									<header>
										<h4><?php the_title(); ?></h4>
									</header>
									
									<?php if(has_post_thumbnail()): ?>
										<a href="<?php echo wp_get_attachment_url(get_post_thumbnail_id()); ?>"><?php the_post_thumbnail('thumbnail', array('class' => 'alignleft', 'title' => get_the_title())); ?></a>
									<?php endif; ?>

									<?php the_excerpt(); ?>
								</article>
	
							<?php endforeach; //$objects ?>
							<?php wp_reset_postdata(); ?>
							<?php wp_reset_query(); ?>
						</section><!-- /. -->
					<?php endif; //$objects ?>
				<?php endforeach; //$sub_cats ?>
			<?php endif; //$sub_cats ?>
			
		<?php endforeach; //$terms ?>
	<?php endif; //$all_objects ?>
*/

/************************************************** CUSTOM FIELDS ********************************************************************************/

/* NAME: Custom Post Type w/ Custom Field Value - Ordered by Menu Order
** Descripiton: This will get all published instances of a custom post type which has a custom field
** set to a certain value - ordered by the user on the backend of WP and let you loop through and display them.
**
** More Info: http://codex.wordpress.org/Class_Reference/WP_Query#Custom_Field_Parameters
**
	<?php
		//This is the query
		global $post;
		
		$cpt_slug = 'custom_post_type_slug'; //Replace custom_post_type_slug with your custom post type's slug
		
		$cf_slug = 'custom_field_slug'; //Replace custom_field_slug with your custom field's slug
		$value = ''; //The value that you want to look for - This can be anything(this means you have to know what you are looking for). See examples below.
		$compare = '='; //If you need to perform a comparison to your custom field, you can enter a value here. Possible values are '=', '!=', '>', '>=', 
						//'<', '<=','LIKE', 'NOT LIKE', 'IN', 'NOT IN', 'BETWEEN', 'NOT BETWEEN', 'EXISTS' (only in WP3.5+), and 'NOT EXISTS'(Only in WP3.5+)

		$objects = get_posts(array(
			'post_type' => $cpt_slug,
			'post_status' => 'publish',
			'orderby' => 'menu_order',
			'order' => 'ASC',
			'meta_query' => array(
				array(
					'key' => $cf_slug,
					'value' => $value,
					'compare' => $compare,  //This is optional, you can delete this line if you only need to check if your field is equal to the above value.
				),
				//If you want to filter by more than one custom field you can just add another array:
				array(
					//example of true/false field - If field's value is true
					'key' => 'true_false_field',
					'value' => true
				),
				array(
					//example of number field - if the field's value >= 5
					'key' => 'number_field', //your custom field slug goes here
					'value' => 5, 
					'compare' => '>='
				),
				array(
					//example of text field - If field's value is Hello
					'key' => 'text_field', //your custom field slug goes here
					'value' => 'Hello'
				)
			),
			'posts_per_page' => -1
		));


		Meta query for NULL OR false from Triple S Suppliers List
		$terms = get_terms([
            'taxonomy' => 'suppliers',
            'meta_query' => array(  
                'relation' => 'OR',
                array ( 
                    'key' => 'hide_from_suppliers_list', 
                    'value' => 'true',
                    'compare'   => '!='
                ),
                array(
                    'key' => 'hide_from_suppliers_list',
                    //'value' => 'null',
                    'compare' => 'NOT EXISTS'                                        
                )
            ),                                    
        ]);
		
		//Check if any posts were found
		if($objects):
			//Loop through the posts
			foreach($objects as $post): setup_postdata($post);
	?>
				<div <?php post_class(); ?>>
					<?php if(has_post_thumbnail()): ?>                                          
						<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
					<?php endif; ?>
					
					the_title();
					the_excerpt();
				</div><!-- /.post -->
	<?php
			endforeach;
			
			//These are important so that the rest of your page will load properly after using this function
			wp_reset_postdata();
			wp_reset_query();
		endif;
	?>
**
*/









/************************************************** WEDGE INTO AUTO CATEOGORIES CUSTOM TAX'S*****************************************************/

/* NAME: To adjust main loop - Ordered by Menu Order
** Descripiton: This will get all published instances of a custom post type which has a custom field
** set to a certain value - ordered by the user on the backend of WP and let you loop through and display them.
**
** More Info: http://codex.wordpress.org/Class_Reference/WP_Query#Custom_Field_Parameters
**
	<?php
		global $wp_query;
		$my_query = array(
			'orderby' => 'menu_order',
			'order' => 'ASC',
			'posts_per_page' => 7
		); //Replace the above values with your custom query
		$args = array_merge($wp_query->query_vars, $my_query);
		
		query_posts($args);
		get_template_part('loop-taxonomy');
	?>
**
*/

?>