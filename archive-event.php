<?php get_header(); ?>

<!-- content START -->
<main id="content" class="archive-page" >
<h1>Local Maker Markets</h1>
<p>Our Maker Markets in Woolwich and South East London showcase makers and artists that live and work locally.</p>
<p>Take a look at our past events, and sign up to our mailing list to make sure you don’t miss our next event.</p>
	
<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); 

	get_template_part( 'content', get_post_type( get_the_ID() ) );
				
	 endwhile; ?>

		<div class="navigation">
			<div><?php next_posts_link('&laquo; Older Entries') ?></div>
			<div><?php previous_posts_link('Newer Entries &raquo;') ?></div>
		</div>

	<?php else : ?>
		
			<h2>Not Found</h2>
			<p>Sorry, but you are looking for something that isn't here.</p>
			<?php // include (TEMPLATEPATH . "/searchform.php"); ?>
		
	<?php endif; ?>
</main>
<!-- content END -->

<?php get_footer(); ?>