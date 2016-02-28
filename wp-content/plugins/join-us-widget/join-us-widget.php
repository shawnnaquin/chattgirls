<?php
/*
Plugin Name: Join Us Widget
Plugin URI: wordpress codex
Description: widget
Author: wordpress codex
Version: 1
Author URI: https://wordpress.com
*/

class join_us_widget extends WP_Widget {
 
 
    /** constructor -- name this the same as the class above */
    function join_us_widget() {
        parent::WP_Widget(false, $name = 'Join Us Widget');    
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
                          'post_type'      => 'page', // set the post type to page
                          'posts_per_page' => 1, // number of posts (pages) to show
                          'name'    => 'join-us', // enter the post ID of the parent page
                          'no_found_rows'  => true,
                        );

                        // query
                        $the_query = new WP_Query( $args );

                        ?>
                        <?php if( $the_query->have_posts() ): ?>
                        <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                          <div class="join-us-widget">
                            <h2><?php the_title(); ?></h2>
                              <div class="row">
                                <div class="columns small-12">
                                  <a href="<?php echo site_url(); ?>/join-us"><?php the_post_thumbnail( 'full' ); ?></a>
                               </div>
                             </div>
                             <div class="row">

                             <div class="columns small-12">
                               <a class="button" href="<?php echo site_url(); ?>/join-us/"><?php the_title(); ?></a>
                             </div>
                             </div>
                          </div>
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
add_action('widgets_init', create_function('', 'return register_widget("join_us_widget");'));
?>