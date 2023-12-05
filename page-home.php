<?php get_header(); ?>

	<!-- content START -->
	<main id="content"><!--wordpress classes-->
		<h1>Bringing you events, handmade products and a community of local makers</h1>
		<figure id="index-img"> <!-- header style image at top of home page-->
			<img src="<?php echo esc_url( get_template_directory_uri() . '/images/market-joy.jpg' ); ?>" alt="A maker is speaking to a customer at and inside market, in the background are lots of other stalls." width="600" height="400">
			<figcaption>Bringing you the joy of buying local and handmade.</figcaption>
		</figure>

		<p id="index-tag"> <!--tag line for the website-->
			We love everything handmade. Discover more about creatives in this corner of South East London. Search our maker directory, find a maker by their name, or browse the products for more information on what and how things are made. 
		</p>


		<h2><a href="<?php echo site_url('/maker-profiles' ); ?>">Browse by Maker</a></h2>
		<p>
			Or take a look at these makers:
		</p>

		
		<div> <!--wp loop 3 most recent maker profiles-->
			<?php
				$loop = new WP_Query(
					array(
						'post_type' => 'maker-profile', // This is the name of my post type,
						'posts_per_page' => 3 // This is the amount of posts per page
					)
				);

				if ( $loop->have_posts() ) :
				while ( $loop->have_posts() ) : $loop->the_post();
					get_template_part( 'content', 'maker-profile') ;
				?>

				<?php endwhile;
				wp_reset_postdata();
				?>


					<?php else : ?>
						<article>
							<h2>Not Found</h2>
							<p>Sorry, but you are looking for something that isn't here.</p>
							<?php include (TEMPLATEPATH . "/searchform.php"); ?>
						</article>
					<?php endif; ?>
		</div>

		<h2>
		<a href="<?php echo site_url('/products' ); ?>">Find a Product</a>
		</h2>
		<p>
			Or check out these latest products. 
		</p>
		<div><!--wordpress loop showing 3 most recent product-->
			<?php
				$loop = new WP_Query(
					array(
						'post_type' => 'product', // This is the name of my post type,
						'posts_per_page' => 3 // This is the amount of posts per page
					)
				);

				if ( $loop->have_posts() ) :
				while ( $loop->have_posts() ) : $loop->the_post();
					get_template_part( 'content', 'product') ;
				?>

				<?php endwhile;
				wp_reset_postdata();
				?>


					<?php else : ?>
						
							<h2>Not Found</h2>
							<p>Sorry, but you are looking for something that isn't here.</p>
							<?php // include (TEMPLATEPATH . "/searchform.php"); ?>
						
					<?php endif; ?>
		</div>	

		<h2>
		Our next Market is:
		</h2>
		
		<p>We don't have any confirmed event details. Why not join our <a href="https://woolwichmakersmarket.us5.list-manage.com/subscribe?u=b7c5e1c3d41486077f45abf12&id=fdc93fb0d1">mailing list</a> to find out when our next event is.</p>

		<h2>
		<a href="<?php echo site_url('/events' ); ?>">Past Markets:</a>
		</h2>

		<?php //loop for showing one past event post
				$loop = new WP_Query(
					array(
						'post_type' => 'event', // This is the name of my post type,
						'posts_per_page' => 1 // This is the amount of posts for index
					)
				);

				if ( $loop->have_posts() ) :
				while ( $loop->have_posts() ) : $loop->the_post();
					get_template_part( 'content', 'event') ;
				?>

				<?php endwhile;
				wp_reset_postdata();
				?>


					<?php else : ?>
						
							<h2>Not Found</h2>
							<p>Sorry, but you are looking for something that isn't here.</p>
							<?php // include (TEMPLATEPATH . "/searchform.php"); ?>
						
					<?php endif; ?>

	</main>
	<!-- content END -->


<?php get_footer(); ?>