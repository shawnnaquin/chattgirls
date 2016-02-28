<?php
/*
Plugin Name: Home Tickets Widget
Plugin URI: wordpress codex
Description: widget
Author: wordpress codex
Version: 1
Author URI: https://wordpress.com
*/

class home_tickets_widget extends WP_Widget {
 
 
    /** constructor -- name this the same as the class above */
    function home_tickets_widget() {
        parent::WP_Widget(false, $name = 'Home tickets Widget');    
    }
 
    /** @see WP_Widget::widget -- do not rename this */
    function widget($args, $instance) { 
        extract( $args );
        $title      = apply_filters('widget_title', $instance['title']);
        $message    = $instance['message'];
        ?>
              <?php echo $before_widget; ?>

                        <?php 

                        // args
                        $args = array(
                          'posts_per_page'  => 1,
                          'post_type'       => 'bout',
                          'meta_key'        => 'display_month',
                          'meta_key'        => 'display_day',
                          'meta_key'        => 'opponent_name',
                          'meta_key'        => 'opponent_logo',
                          'meta_key'        => 'opponent_link',
                          'meta_key'        => 'home_or_away',
                          'meta_value'      => 'Home'
                        );

                        // query
                        $the_query = new WP_Query( $args );

                        ?>
                        <div class="home-tickets-widget">
                        <h2>Tickets</h2>
                        <p class="buy"><a href="#">Buy Tickets</a> for Chattanooga Roller Girls’<br/>next home bout</p>
                        <p class="at">&#64;the</p>
                        <?php if( $the_query->have_posts() ): ?>
                        <?php while ( $the_query->have_posts() ) : $the_query->the_post();
                            $location = get_field('location');
                            $address = explode( ',' , $location['address']);
                        ?>
                        <a href="#" class="venue"><?php echo $address[0]; // place address ?> </a>
                        <h2>Next <span>Home</span> Bout</h2>
                        <div class="vs">
                          <div class="vs-date">
                            <div class="vs-date-month">
                              <?php echo get_field('display_month'); ?><br/>
                            </div>
                            <div class="vs-date-day">
                              <?php echo get_field('display_day'); ?><br/>  
                            </div>
                          </div>

                          <div class="vs-logos">
                          
                            <div class="vs-logos-home">
                              <?php $upload_dir = wp_upload_dir(); ?>
                              <a href="<?php echo site_url(); ?>">
                              <?php echo file_get_contents($upload_dir['baseurl'] . "/rollergirls_opt.svg")?>
                              </a>
                            </div>

                            <div class="vs-logos-text">
                              vs.
                            </div>

                            <div class="vs-logos-away">
                              <?php $img = get_field('opponent_logo'); ?>
                              <a href="<?php echo get_field('opponent_link'); ?>" target="_blank">
                              <img src="<?php echo $img['url']; ?>" alt="<?php echo $img['alt']; ?>"/>
                              </a>
                            </div>

                          </div>
                        </div>
                        <a class="button bright">buy tickets</a>
                        <?php endwhile; ?>
                        <?php endif; ?>
                        <?php wp_reset_query();  // Restore global post data stomped by the_post(). ?>
                        </div>


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
add_action('widgets_init', create_function('', 'return register_widget("home_tickets_widget");'));
?>