<?php
/*
Plugin Name: Schedule Widget
Plugin URI: wordpress codex
Description: schedule widget
Author: wordpress codex
Version: 1
Author URI: https://wordpress.com
*/

class schedule_widget extends WP_Widget {
 
 
		/** constructor -- name this the same as the class above */
		function schedule_widget() {
				parent::WP_Widget(false, $name = 'Schedule Widget');    
		}
 
		/** @see WP_Widget::widget -- do not rename this */
		function widget($args, $instance) { 
				extract( $args );
				$title      = apply_filters('widget_title', $instance['title']);
				$homepage_amt      = $instance['homepage_amt'];
				$interior_amt      = $instance['interior_amt'];
				?>
							<?php echo $before_widget; ?>
									<?php if ( $title ) ?>
											 <h2><?php echo date('Y'); ?> <?php echo $title ?></h2>

											 <?php
											 	
											 	$amt = $interior_amt;

											 	if ( is_front_page() ) {
											 		$amt = $homepage_amt;
											 	}

												$args = array(
													'posts_per_page' => $amt,
													'order'     => 'ASC',
													'post_type'   => 'bout',
													'meta_key'    => 'dis	play_day',
													'meta_key'    => 'location',
													'meta_key'   => 'opponent_logo',
													'meta_key'    => 'home_or_away',
													'meta_key'	=> 'opponent_link',
													'meta_key'	=> 'map_link'
												);

												// query
												$the_query = new WP_Query( $args );

												?>
												<?php if( $the_query->have_posts() ): ?>
														
												<?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>

												<!-- home or away? -->
												<?php if ( get_field('home_or_away') == 'Home'): ?>
													<div class="bout home" href="<?php the_permalink(); ?>">
												<?php else: ?>
													<div class="bout" href="<?php the_permalink(); ?>">
												<?php endif; ?>
														<div>
															<div class="bout-under">

																<div class="bout-wrapper columns small-12 no-padding">
																	<div class="bout-date small-5 columns">
																		<div class="bout-date-day">
																			<?php the_field('display_day'); ?>.
																		</div>
																		<div class="bout-date-month">
																			<?php the_field('display_month'); ?>
																		</div>
																	</div> <!-- bout-date -->

																	<div class="vs-logos small-7 columns">
																	
																	  <div class="vs-logos-home">
																	  	<a href="#" class="js-noclick">
																	  		<img src="<?php echo get_option('site_logo'); ?>" />
																	  	</a>
																	  </div>

																	  <div class="vs-logos-text">
																	    vs.
																	  </div>

																	  <div class="vs-logos-away">
																	    <?php $img = get_field('opponent_logo'); ?>
																	    <a href="<?php the_field('opponent_link'); ?>" title="" target="_blank" >
																	    	<img src="<?php echo $img['url']; ?>" alt="<?php echo $img['alt']; ?>"/>
																	    </a>
																	  </div>

																	</div> <!-- vs-logos -->
																</div>

																<div class="bout-info js-bout-info small-12 columns no-padding">

																	<div class="bout-under-text" href="#">
																		<div class="bout-under-text-wrapper">
																			<div class="bout-under-text-container">
																				<a class="bout-under-text-button" href="#ticketsite">Buy Tickets</a>
																				<?php 
																					if ( get_field('home_or_away') == 'Home') {
																						$url = get_option('bout_map');
																					} else {
																						$url = get_field('map_link');
																					}
																				?>
																				<a class="bout-under-text-button" href="<?php echo $url ?>" target="_blank">View Map</a>
																			</div>
																		</div>
																	</div>

																	<div class="bout-info-title">
																		<p>
																			<?php the_field('which_team'); ?>
																			<span>vs.</span>
																			<?php the_field('opponent_name'); ?>
																		</p>
																	</div>

																	<?php 
																	$location = get_field('location');
																	$address = explode( ',' , $location['address']);
																	?>

																	<div class="bout-info-location">
																		<div class="bout-info-location-street">
																			<?php echo $address[0]; // street address ?> 
																		</div>
																		<div class="bout-info-location-city js-city">
																			<?php echo $address[2].','.$address[3]; // city, state zip ?>
																		</div>
																	</div> <!-- info-location -->
																</div> <!-- info -->
															</div> <!-- under -->
														</div>
													</div>
												<?php endwhile; ?>
											<?php endif; ?>

												<?php wp_reset_query();  // Restore global post data stomped by the_post(). ?>


							<?php echo $after_widget; ?>
				<?php
		}
 
		/** @see WP_Widget::update -- do not rename this */
		function update($new_instance, $old_instance) {     
				$instance = $old_instance;
				$instance['title'] = strip_tags($new_instance['title']);
				$instance['homepage_amt'] = strip_tags($new_instance['homepage_amt']);
				$instance['interior_amt'] = strip_tags($new_instance['interior_amt']);
				return $instance;
		}
 
		/** @see WP_Widget::form -- do not rename this */
		function form($instance) {  
 
				$title      = esc_attr($instance['title']);
				$homepage_amt      = esc_attr($instance['homepage_amt']);
				$interior_amt      = esc_attr($instance['interior_amt']);

				?>

				<p>
					<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> 
					<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
				</p>

				<p>
					<label for="<?php echo $this->get_field_id('homepage_amt'); ?>"><?php _e('Amount of posts to show on home-page:'); ?></label> 
					<input class="widefat" id="<?php echo $this->get_field_id('homepage_amt'); ?>" name="<?php echo $this->get_field_name('homepage_amt'); ?>" type="text" value="<?php echo $homepage_amt; ?>" />
				</p>

				<p>
					<label for="<?php echo $this->get_field_id('interior_amt'); ?>"><?php _e('Amount of posts to show on interior pages:'); ?></label> 
					<input class="widefat" id="<?php echo $this->get_field_id('interior_amt'); ?>" name="<?php echo $this->get_field_name('interior_amt'); ?>" type="text" value="<?php echo $interior_amt; ?>" />
				</p>

				<?php 
		}
 
 
} // end class example_widget
add_action('widgets_init', create_function('', 'return register_widget("schedule_widget");'));
?>