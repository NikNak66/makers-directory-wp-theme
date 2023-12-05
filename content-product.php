	<!-- start of content-->

	<a class="product-quick-ref" href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"> <!-- wrap post info in a card with link-->

		<h2><?php the_field('title_description'); ?></h2>

		<figure>
			<?php //array to display image as well as alt description
			$image = get_field('thumbnail_image');?>
			<img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" width="<?php echo esc_attr($image['width']); ?>" height="<?php echo esc_attr($image['height']); ?>"/>

			<figcaption><?php the_field('thumbnail_caption'); ?></figcaption>		
		</figure>

		<dl> 
			<dt>Price</dt><dd>£<?php the_field('price_of_item'); ?></dd>
			
					<?php //array because its a taxonomy field
						$neighbourhood = get_field('choose_neighbourhood');?>
			
			<dt>Made In</dt><dd><?php echo esc_html( $neighbourhood->name ); ?></dd>
			
					<?php //array because its a taxonomy field
					$business = get_field('choose_business'); ?>
			<dt>Made by</dt><dd><?php echo esc_html( $business->name ); ?></dd>
		</dl>
	</a> <!--card and link end-->

<!-- end of content -->

