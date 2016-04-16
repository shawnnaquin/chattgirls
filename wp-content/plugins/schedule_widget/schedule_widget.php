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
				$message    = $instance['message'];
				?>
							<?php echo $before_widget; ?>
									<?php if ( $title ) ?>
											 <h2><?php echo date('Y'); ?> <?php echo $title ?></h2>

											 <?php 
												// args
												$args = array(
													'numberposts' => 10,
													'order'     => 'ASC',
													'post_type'   => 'bout',
													'meta_key'    => 'display_day',
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
																	  	<a href="<?php site_url(); ?>">
																	  		<img src="http://roll.com/wp-content/uploads/crglogo_1-e1453139559423.png" />
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

																	<div class="bout-under-text" href="#" data-equalizer-watch="bout"  >
																		<a class="bout-under-text-button" href="#ticketsite">Buy Tickets</a>
																		<?php 
																			if ( get_field('home_or_away') == 'Home') {
																				$url = 'https://www.google.com/maps/place/Chattanooga+Convention+Center/@35.0421656,-85.3148647,17z/data=!3m1!4b1!4m2!3m1!1s0x88605fe003a11409:0xc5d1acbee121b58a';
																			} else {
																				$url = get_field('map_link');
																			}
																		?>
																		<a class="bout-under-text-button" href="<?php echo $url ?>" target="_blank">View Map</a>
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
																		<div class="bout-info-location-city">
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
				$instance['message'] = strip_tags($new_instance['message']);
				return $instance;
		}
 
		/** @see WP_Widget::form -- do not rename this */
		function form($instance) {  
 
				$title      = esc_attr($instance['title']);
				$message    = esc_attr($instance['message']);
				?>
				 <p>
					<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> 
					<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
				</p>
				<p>
					<label for="<?php echo $this->get_field_id('message'); ?>"><?php _e('Simple Message'); ?></label> 
					<input class="widefat" id="<?php echo $this->get_field_id('message'); ?>" name="<?php echo $this->get_field_name('message'); ?>" type="text" value="<?php echo $message; ?>" />
				</p>
				<?php 
		}
 
 
} // end class example_widget
add_action('widgets_init', create_function('', 'return register_widget("schedule_widget");'));
?>