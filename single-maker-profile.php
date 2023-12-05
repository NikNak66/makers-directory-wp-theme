<?php get_header(); ?>

<!--WP loop starts, its a single post-->
	<div id="content">

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>


		<main class="maker-profile"> <!--start of maker profile information, from ACF plug in-->
			
			<div class="maker-quick-ref"> <!--start quick ref div - - grid for information at the top of the page, used to display all the most useful information as a quick reference to the user-->
				<h1><?php the_field('maker_name'); ?></h1>
				<h2>Meet the Maker</h2>
				<picture>
					<img src="<?php echo esc_url( get_template_directory_uri() . '/images/meet-maker-banner.svg' ); ?>" alt="dymo label style font, black background and white font. The font reads Meet the Maker which replaces the H2 heading" width="200" height="33.3">
				</picture>
				
				<figure class="polaroid-image">
					<?php //fetching the image array so that image and alt description will show in HTML
						$image = get_field('profile_image');?> 

					<img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" width="<?php echo esc_attr($image['width']); ?>" height="<?php echo esc_attr($image['height']); ?>"/>

					<figcaption><?php the_field('maker_name'); ?></figcaption>		
				</figure>

				<h3>Business Name</h3>
					<?php //fetching the field as it is a taxonomy list
						$business_name = get_field('business_name');?>
				<p><?php echo esc_html( $business_name->name ); ?></p>

				<h3>Known For</h3>
				<p><?php the_field('known_for'); ?> </p>

				<h3>Neighbourhood</h3>
				<?php //fetching the neighbourhood field, as it is a taxonomoy field
					$neighbourhood = get_field('neighbourhood');?>
				<p><?php echo esc_html( $neighbourhood->name ); ?></p>

				<h3>How to Buy</h3>
				<p> <?php //applying variable names to the array so that the link with the title will display		
					$link = get_field('how_to_buy');
					$link_url = $link['url'];
					$link_title = $link['title'];
					$link_target = $link['target'] ? $link['target'] : '_self';
					?>
					<a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a></p>
					<?php; ?>
			</div><!-- end of quick ref info-->

			<div class="bio"> <!--start of written bio content-->
				<h2><?php the_field('maker_name'); ?>, the Maker</h2>

				<p><?php the_field('first_paragraph'); ?> </p>
				<figure>
					<?php //getting the array so that the alt description will display
					$image = get_field('creating_image');?>

					<img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" width="<?php echo esc_attr($image['width']); ?>" height="<?php echo esc_attr($image['height']); ?>"/>

					<figcaption><?php the_field('creating_image_caption'); ?></figcaption>		
				</figure>

				<p><?php the_field('second_paragraph'); ?> </p>
					<figure>
						<?php //getting the array so that the alt description will display
						$image = get_field('work_area');?>

						<img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" width="<?php echo esc_attr($image['width']); ?>" height="<?php echo esc_attr($image['height']); ?>"/>

					<figcaption><?php  the_field('work_area_caption'); ?> </figcaption>
					</figure>


				<p><?php the_field('third_paragraph'); ?> </p>


				<p><?php the_field('fourth_paragraph'); ?> </p>


					</div><!--end of biography content-->
			
		<!--start of display of products-->
			<h2>Products made by <?php the_field('maker_name'); ?></h2>
								
				<?php $makerbiz = get_field('business_name' , get_the_ID()); //findiing the tax term from the current maker post

				if ($makerbiz) {

					$args = array(// filtering product posts to find the matching taxonomy
						'post_type' => 'product', // finding the custom post type
						'tax_query' => array(
												array(
												'taxonomy' => 'business', // using this custom post type taxonomy field
												'field' => 'id',
												'terms' => $makerbiz ->term_id,
												),
											),
					);

					$product_query = new WP_Query($args); //new wp query comparing current taxonomy to related taxonomy in product listing

					
					if ($product_query->have_posts()) :

					while ($product_query->have_posts()) :
							$product_query->the_post();?>

<!--card info and link to maker products-->
										
			<a class="product-quick-ref" href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"> <!-- wrap post info in a card with link-->

				<h3><?php the_field('title_description'); ?></h3>

				<figure>
									<?php 
									$image = get_field('thumbnail_image');?>
					<img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>"/>
					<figcaption><?php the_field('thumbnail_caption'); ?></figcaption>		
				</figure>

				<dl> <!-- removed tag <dl id="short-product-details"> found alt selector and also keep DL layout consitent with rest of page-->
					<dt>Price</dt><dd>£<?php the_field('price_of_item'); ?></dd>
					<dt>Delivery Cost</dt><dd><?php the_field('delivery_cost'); ?></dd>
					<dt>Size</dt><dd><?php the_field('size'); ?></dd>
					<dt>Colour</dt><dd><?php the_field('colour'); ?></dd>
					<dt>Made In</dt>
										<?php 
										$neighbourhood = get_field('choose_neighbourhood');?>
								<dd><?php echo esc_html( $neighbourhood->name ); ?></dd>
					<dt>Made by</dt>
												
										<?php 
										$business = get_field('choose_business');?>
						<dd><?php echo esc_html( $business->name ); ?></dd>
			</dl>

			</a>
							
<!-- End of Card info and link to maker products unless maker has none -->
						
						<?php
						endwhile;
						wp_reset_postdata(); // Restore the original post data
						else :
							// No related "product" posts found
							?>

                	<p>This maker doesnt have any product listed on our website at the moment.  Why not take a look at <a href="<?php echo site_url('/products' ); ?>">our products page instead.</a> Or check out a list of their useful links below.</p> 
<!-- End of Card info and link to maker products when maker has none -->		

						<?php
						endif;

       					}//end of if maker biz and new wp query
       					?>

					<h3>Other Useful Links for <?php the_field('maker_name'); ?></h3>
						<ul>
							<li><a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a></li>
												<?php //fetching the link array
													$link = get_field('instagram');
													if( $link ): 
														$link_url = $link['url'];
														$link_title = $link['title'];
														$link_target = $link['target'] ? $link['target'] : '_self';
													?>
							<li><a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
												<?php endif; ?>

												<?php 
												$link = get_field('facebook');
												if( $link ): 
													$link_url = $link['url'];
													$link_title = $link['title'];
													$link_target = $link['target'] ? $link['target'] : '_self';
												?>
							<li><a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
												<?php endif; ?>

												<?php 
												$link = get_field('twitter');
												if( $link ): 
													$link_url = $link['url'];
													$link_title = $link['title'];
													$link_target = $link['target'] ? $link['target'] : '_self';
												?>
							<li><a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
												<?php endif; ?>

												<?php $link = get_field('tiktok');
												if( $link ): 
													$link_url = $link['url'];
													$link_title = $link['title'];
													$link_target = $link['target'] ? $link['target'] : '_self';
												?>
							<li><a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
												<?php endif; ?>
												<?php 
												$link = get_field('other_useful_links');
												if( $link ): 
													$link_url = $link['url'];
													$link_title = $link['title'];
													$link_target = $link['target'] ? $link['target'] : '_self';
												?>
							<li><a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
												<?php endif; ?>

						</ul>
    	</main><!-- End of maker-profile unless no content found -->
			
			<?php endwhile; else : ?>

				 <!--displays if no content found-->
					<h2>Not Found</h2>
					<p>Sorry, but you are looking for something that isn't here.</p>
					<?php // include (TEMPLATEPATH . "/searchform.php"); ?>
				

			<?php endif; ?>					
	</div><!-- content END -->

<?php get_footer(); ?>

