<?php
/*
Plugin Name: Featured Skater Widget
Plugin URI: wordpress codex
Description: widget
Author: wordpress codex
Version: 1
Author URI: https://wordpress.com
*/

class featured_skater_widget extends WP_Widget {


	/** constructor -- name this the same as the class above */
	function featured_skater_widget() {
		parent::WP_Widget(false, $name = 'Featured Skater Widget');
	}

	/** @see WP_Widget::widget -- do not rename this */
	function widget($args, $instance) {
		extract( $args );
		$title      = apply_filters('widget_title', $instance['title']);
		$message    = $instance['message'];
		?>
		<?php echo $before_widget; ?>
		<?php if ( $title ) ?>
		<?php

// args
		$args = array(
			'post_type'=>'skater',
			'orderby'=>'rand',
			'meta_key' => 'display_name',
			'meta_key' => 'number',
			'meta_key' => 'years_with',
			'meta_key' => 'likes',
			'posts_per_page'=>'1',
			);

// query
		$the_query = new WP_Query( $args );

		?>

		<?php if( $the_query->have_posts() ): ?>

			<?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>
				<div class="featured-skater-widget">
					<div class="row">
						<div class="columns small-12">
							<h2 class="featured-skater-title">Featured Skater</h2>
						</div>
					</div>

					<div class="row">
						<div class="columns small-6 featured-skater-image">
							<a href="<?php echo site_url(); ?>/skaters#<?php echo the_field('number'); ?>"><?php the_post_thumbnail('full'); ?></a>
						</div>

						<div class="small-6 columns featured-skater-name no-padding">
							<?php
							$num = get_field('number');
							if ( get_field('display_name') ) {
								$dn = get_field('display_name');
							}
							?>
							<h3 class="featured-skater-name">
								<?php if ($dn) { echo $dn; } else { echo the_title(); } ?>
								<br/>
								#<?php echo $num; ?></h3>
						</div>
					</div>
					<div class="row">

						<div class="columns small-12 featured-skater-info">
						<?php if ( !empty( get_field('years_with') ) ) : ?>
							<div class="small-12 columns featured-skater-years no-padding">
								<p class="featured-skater-label">Years with CRG:</p>
								<p class="featured-skater-answer"><?php echo get_field('years_with');?></p>
							</div>
						<?php endif; ?>
						<?php if ( !empty( get_field('likes') ) ) : ?>
							<div class="small-12 columns featured-skater-years no-padding">
								<p class="featured-skater-label">Likes:</p>
								<p class="featured-skater-answer"><?php echo get_field('likes');?></p>
							</div>
						<?php endif; ?>
						</div>
					</div>
					<a class="button" href="<?php echo site_url(); ?>/skaters">View All Skaters</a>
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
add_action('widgets_init', create_function('', 'return register_widget("featured_skater_widget");'));
?>