<!-- content START -->

<a class="maker-quick-ref" href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"> <!-- wrap post info in a card with link-->

<figure class="polaroid-image">
		<?php // create array so that both image and alt descriptions displayed 
		$image = get_field('profile_image');?>
	<img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" width="<?php echo esc_attr($image['width']); ?>" height="<?php echo esc_attr($image['height']); ?>"/>
	<figcaption><?php the_field('maker_name'); ?></figcaption>		
</figure>

<h3>Business Name</h3>
	<?php // create array because this is a taxonomy field
	$term = get_field('business_name');?>
<p><?php echo esc_html( $term->name ); ?></p>

<h3>Known For</h3>
<p><?php the_field('known_for'); ?> </p>

<h3>Neighbourhood</h3>
	<?php // create array because this is a taxonomy field
	$term = get_field('neighbourhood');?>
<p><?php echo esc_html( $term->name ); ?></p>

</a> <!--end of card and link to rest of post-->

<!-- content END -->
