<?php
/*
Plugin Name: ScoreBoards Widget
Plugin URI: wordpress codex
Description: widget
Author: wordpress codex
Version: 1
Author URI: https://wordpress.com
*/
class scoreboards_widget extends WP_Widget {


	/** constructor -- name this the same as the class above */
	function scoreboards_widget() {
		parent::WP_Widget(false, $name = 'ScoreBoards Widget');
	}

	/** @see WP_Widget::widget -- do not rename this */
	function widget($args, $instance) {
		extract( $args );
		$title      = apply_filters('widget_title', $instance['title']);
		$message    = $instance['message'];

		echo $before_widget;

		for ($i=date('Y'); $i>=2010; $i--) :

			if ($i == '2016') {
				$id = $i;
			}

		?>

			<div class="shawns-faq-widget">
			<ul class="accordion" data-accordion >
				<li id="<?php echo $i; ?>" class="accordion-item" data-accordion-item>
				  <a href="#" class="accordion-title"><?php echo $i; ?></a>
					  <div class="accordion-content accordion-content-scoreboard" data-tab-content>
		<?php

// args
		$args = array(
			'posts_per_page'  => -1,
			'post_type'       => 'scoreboard',
			'category_name'   => $i,
			'meta_key'        => 'date',
			'meta_key'        => 'away_logo',
			'meta_key'        => 'away_name',
			'meta_key'        => 'away_acronym',
			'meta_key'        => 'location',
			'meta_key'        => 'outcome',
			'meta_key'        => 'home_score',
			'meta_key'        => 'away_score',
			);

// query
		$the_query = new WP_Query( $args );
?>
			<?php if( $the_query->have_posts() ): ?>
				<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
					<?php
						$date = get_field('date', false, false);
						$date = new DateTime($date);

						if ( get_field('outcome') == 'win' ) {
							$home_outcome_class = 'win';
							$away_outcome_class = 'loss';
						} else {
							$home_outcome_class = 'loss';
							$away_outcome_class = 'win';
						}

					?>

					<div class="small-12 columns scoreboard-bout">
						<div class="small-12 medium-12 large-2 columns scoreboard-date">
							<?php echo $date->format('m/d/y'); ?><br/>
						</div>

						<div class="small-12 medium-12 large-6 columns scoreboard-vs">
							<?php echo get_option('team_acronym'); ?>
							<span class="vs">vs</span>
							<?php echo get_field('away_name');?>&nbsp;<small>(<?php echo get_field('location');?>)</small>
						</div>

						<div class="small-12 medium-12 large-4 columns scoreboard-bout-info <?php echo get_field('outcome'); ?>">

							<div class="win-or-loss">
								<span class="win-or-loss-span">
									<?php if ( get_field('outcome') == 'win' ) : ?>W<?php else : ?>L<?php endif; ?>
								</span>
								<span class="win-or-loss-emdash">
									&mdash;
								</span>
							</div>

							<div class="home-score <?php echo $home_outcome_class; ?>">
								<span class="home-score-acronym acronym"><?php echo get_option('team_acronym'); ?></span>
								<span class="home-score-number score"><?php echo get_field('home_score');?></span>
							</div>

							<div class="away-score <?php echo $away_outcome_class; ?>">
								<span class="away-score-acronym acronym"><?php echo get_field('away_acronym');?></span>
								<span class="away-score-number score"><?php echo get_field('away_score');?></span>
							</div>

						</div>
					</div>
				<?php endwhile; ?>

			<?php endif; ?>
			<?php wp_reset_query(); ?>
					  </div>
					</li>
				</ul>
			</div>
			<?php endfor; // Restore global post data stomped by the_post(). ?>


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
add_action('widgets_init', create_function('', 'return register_widget("scoreboards_widget");'));
?>