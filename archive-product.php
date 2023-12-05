<?php get_header(); ?>

<!-- content START -->
<main id="content" class="archive-page" >
	<h1>Browse Handmade Products</h1>
	<p>Have a look at what local creatives in South East London are making. Find out how they make it and where you can buy from them:</p>
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