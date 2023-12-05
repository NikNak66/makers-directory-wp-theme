<!-- content START -->


<a class="h-event" href="https://woolwichmakersmarket.org//events/"><!--temporary, change to link to the full post when more info to posts has been added --- the_permalink() ?>" rel="bookmark" title="Permanent Link to  the_title_attribute(); ?>"-->

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
</a>

<!-- content END -->

