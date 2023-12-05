<?php get_header(); ?>

	<!--WP Loop starts, single event page-->
	<div id="content"> <!--Wp Class-->

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<main class="market-events"> <!--market event info-->

			<div class="h-event"><!--class for meta data/ seo -->

				<picture>
					<?php //getting the field array so that alt will display
					$image = get_field('event-image');?>

					<img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" width="<?php echo esc_attr($image['width']); ?>" height="<?php echo esc_attr($image['height']); ?>"/>

				</picture>

				<h2><?php the_field('event_name'); ?></h2>

					<?php //geting the array from two fields to display the start and end time together, and to display the time of day am/pm
							$start_date_str = get_field('start_date_and_time');
							$start_date_time_array = (explode(',',$start_date_str));

							$start_date = $start_date_time_array[0];
							$start_time = $start_date_time_array[1];

							$end_date_str = get_field('end_date_and_time');
							$end_date_time_array = (explode(',',$end_date_str));

							$end_time = $end_date_time_array[1];
							$am_pm = $end_date_time_array[2];
					?>

				<ul> 
					<!--Event Date-->   
					<li><img src="<?php echo esc_url( get_template_directory_uri() . '/images/calendar-v2.svg' ); ?>" alt="black calendar icon" width="16" height="21"></li>
					<li><?php echo ($start_date)  ?></li>

					<!--Event Time--> 
					<li><img src="<?php echo esc_url( get_template_directory_uri() . '/images/clock.svg' ); ?>" alt="black clock icon" width="16" height="21"></li>
					<li><?php echo ($start_time)?> - <?php echo ($end_time); echo ($am_pm)?></li>
					
					<!--Event Location--> 
					<li><img src="<?php echo esc_url( get_template_directory_uri() . '/images/location.svg' ); ?>" alt="black location icon" width="16" height="21"></li>
					<li><?php the_field('location'); ?></li>
				</ul>
			</div><!-- end of event info-->


		</main>


		<?php endwhile; else: ?>
			
				<h2>Not Found</h2>
				<p>Sorry, but you are looking for something that isn't here.</p>
				<?php // include (TEMPLATEPATH . "/searchform.php"); ?>
			
		<?php endif; ?>

	</div>
	<!-- content END -->

<?php get_footer(); ?>