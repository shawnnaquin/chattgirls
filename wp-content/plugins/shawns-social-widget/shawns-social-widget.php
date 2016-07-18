<?php
/*
Plugin Name: Shawns Social Widget
Plugin URI: wordpress codex
Description: widget
Author: wordpress codex
Version: 1
Author URI: https://wordpress.com
*/
class shawns_social_widget extends WP_Widget {


    /** constructor -- name this the same as the class above */
    function shawns_social_widget() {
        parent::WP_Widget(false, $name = 'ShawnsSocial Widget');    
    }

    /** @see WP_Widget::widget -- do not rename this */
    function widget($args, $instance) { 
        extract( $args );
        $sharrre_url      = $instance['sharrre_url'];
        $data_text    = $instance['data_text'];
        $data_hashtags = $instance['data_hashtags'];
        ?>
        <?php echo $before_widget; ?>
        
            <div class="row">
              <div class="columns small-12 social-icon-wrapper">
                 <div class="columns small-6 small-offset-3 large-8 large-offset-2 no-padding js-sharrre" data-hashtags="<?php echo $data_hashtags ?>" data-href="<?php echo site_url();?><?php echo $sharrre_url; ?>" data-text="<?php echo $data_text; ?>">
                    <div class="small-4 columns js-facebook"></div>
                    <div class="small-4 columns js-pinterest"></div>
                    <div class="small-4 columns js-twitter"></div>
                 </div>
              </div>
            </div>

        <?php echo $after_widget; ?>
    <?php
    }

    /** @see WP_Widget::update -- do not rename this */
    function update($new_instance, $old_instance) {     
        $instance = $old_instance;
        $instance['sharrre_url'] = strip_tags($new_instance['sharrre_url']);
        $instance['data_text'] = strip_tags($new_instance['data_text']);
        $instance['data_hashtags'] = strip_tags($new_instance['data_hashtags']);
        return $instance;
    }

    /** @see WP_Widget::form -- do not rename this */
    function form($instance) {  
        $sharrre_url      = esc_attr($instance['sharrre_url']);
        $data_text    = esc_attr($instance['data_text']);
        $data_hashtags    = esc_attr($instance['data_hashtags']);
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('sharrre_url'); ?>"><?php _e('Sharrre URL:'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('sharrre_url'); ?>" name="<?php echo $this->get_field_name('sharrre_url'); ?>" type="text" value="<?php echo $sharrre_url; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('data_text'); ?>"><?php _e('Text to share'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('data_text'); ?>" name="<?php echo $this->get_field_name('data_text'); ?>" type="text" value="<?php echo $data_text; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('data_hashtags'); ?>"><?php _e('Hashtags (,)'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('data_hahtags'); ?>" name="<?php echo $this->get_field_name('data_hashtags'); ?>" type="text" value="<?php echo $data_hashtags; ?>" />
        </p>
        <?php 
    }


} // end class example_widget

add_action('widgets_init', create_function('', 'return register_widget("shawns_social_widget");'));
?>