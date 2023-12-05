<?php get_header(); ?>

<!-- WP LOOP STARTS, loop is just one post-->
	<div id="content">
		
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<main class="product-listing"> <!-- content START, post layout for products. Info is from ACF Plug in -->
			
			<div class="product-quick-ref"> <!-- a quick reference shown at the top of the page, visitor should be able to get the info they are looking for quickly, Div helps to display as grid -->

				<h1><?php the_field('title_description'); ?></h1>

				<figure>
				<?php 
						$image = get_field('thumbnail_image');?>
					<img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" width="<?php echo esc_attr($image['width']); ?>" height="<?php echo esc_attr($image['height']); ?>"/>
					<figcaption><?php the_field('thumbnail_caption'); ?></figcaption> 	
				</figure>

				<h2><?php the_field('short_description'); ?></h2>

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

				<p> <?php		
					$link = get_field('link_to_buy');
					if( $link ): 
					$link_url = $link['url'];
					$link_title = $link['title'];
					$link_target = $link['target'] ? $link['target'] : '_self';?>
								
					<a class="how-to-buy" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
				</p><?php endif; ?>

				<p><?php the_field('long_description'); ?></p>
			</div> <!--end of quick reference for product-->
					
			<div class="how-made"> <!-- information about how the product was made -->

				<h2>How was it made</h2>

				<p><?php the_field('how_made'); ?> </p>

				<figure>
							<?php $image = get_field('image_of_making');?>

					<img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" width="<?php echo esc_attr($image['width']); ?>" height="<?php echo esc_attr($image['height']); ?>"/>
					
					<figcaption><?php the_field('image_of_making_caption'); ?></figcaption>		
				</figure>
						
				<div id="how-made-inline"> <!--inline grid for materials and equipment - part of how the product was made-->
					<h3>Materials</h3>
					<ul>
						<?php //splitting value into array
							$str = get_field('materials');
							$array = (explode(',',$str));

							foreach ($array as $item){
								echo "<li>$item</li>";
							}
							?>
					</ul>
						

					<h3>Equipment</h3>
					
					<ul>
						<?php //splitting value into array
							$str = get_field('equipment');
							$array = (explode(',',$str));
							foreach ($array as $item){
								echo "<li>$item</li>";
							}
							?>
					</ul>
				</div><!--end of how it was made inline grid-->
				
			</div><!--end of "how was it made section-->
			
			<div class="who-made-it"><!--card info and link to maker-profile-->
			<h2>Who Made It</h2>
				<?php
					// Get the related "Maker" posts using ACF Relationship field
					$related_makers = get_field('maker-profile'); // Replace with your ACF field name, e.g., 'related_maker'

					if ($related_makers) :
						foreach ($related_makers as $related_maker) : ?> <!--php note to use new variable as a new term and use the term to call the related data-->
							<a class="maker-quick-ref" href="<?php echo esc_url(get_permalink($related_maker)); ?>" rel="bookmark" title="Permanent Link to <?php echo esc_attr(get_the_title($related_maker)); ?>">
								<figure class="polaroid-image">
									<?php
									$image = get_field('profile_image', $related_maker);
									?>
									<img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" width="<?php echo esc_attr($image['width']); ?>" height="<?php echo esc_attr($image['height']); ?>" />
									<figcaption><?php the_field('maker_name', $related_maker); ?></figcaption>
								</figure>

								<h3>Business Name</h3>
								<?php
								$term = get_field('business_name', $related_maker);
								?>
								<p><?php echo esc_html($term->name); ?></p>

								<h3>Known For</h3>
								<p><?php the_field('known_for', $related_maker); ?></p>

								<h3>Neighbourhood</h3>
								<?php
								$term = get_field('neighbourhood', $related_maker);
								?>
								<p><?php echo esc_html($term->name); ?></p>
							</a>
			</div><!--end of card info and link to maker-profile-->

					<?php endforeach;
					endif;
					?>

				<?php endwhile; else: ?>
			
				<h2>Not Found</h2>
				<p>Sorry, but you are looking for something that isn't here.</p>
				<?php // include (TEMPLATEPATH . "/searchform.php"); ?>
			
				<?php endif; ?>
							
		</main><!--end of content-->
	</div>
	<!-- content END -->

<?php get_footer(); ?>
