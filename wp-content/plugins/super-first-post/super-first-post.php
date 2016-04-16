<?php
/*
Plugin Name: Super First Post
Plugin URI: super first post
Description: super first post
Author: wordpress codex
Version: 1
Author URI: https://wordpress.com
*/

class super_first_post extends WP_Widget {
 
 
        /** constructor -- name this the same as the class above */
        function super_first_post() {
                parent::WP_Widget(false, $name = 'Super First Post');    
        }
 
        /** @see WP_Widget::widget -- do not rename this */
        function widget($args, $instance) { 
                extract( $args );
                $title      = apply_filters('widget_title', $instance['title']);
                $message    = $instance['message'];
                ?>
                            <?php echo $before_widget; ?>
                                    <?php if ( $title ) ?>
                                            <div class="new-in-news">
                                             <h2><?php echo $title ?></h2>

                                             <div class="new-in-news-container">
                                                <?php
                                                    $args = array( 'numberposts' => '1' );
                                                    $recent_posts = wp_get_recent_posts( $args );
                                                    foreach( $recent_posts as $recent ){
                                                        echo '<a href="' . get_permalink($recent["ID"]) . '">' .   $recent["post_title"].'</a>';
                                                ?>
                                                    <div class="new-in-news-post">
                                                    <?php $content = $recent['post_content']; ?>
                                                    <?php echo substr($content, 0, 300); ?>&hellip;
                                                    </div>
                                                    <a class="button reverse" href="http://roll.com/events/">View More</a>
                                                <?php } ?>
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
add_action('widgets_init', create_function('', 'return register_widget("super_first_post");'));
?>