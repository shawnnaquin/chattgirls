<?php
/*
Plugin Name: Derby FAQ Widget
Plugin URI: wordpress codex
Description: widget
Author: wordpress codex
Version: 1
Author URI: https://wordpress.com
*/
class derby_faq_widget extends WP_Widget {


    /** constructor -- name this the same as the class above */
    function derby_faq_widget() {
        parent::WP_Widget(false, $name = 'Derby FAQ Widget');
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
            'posts_per_page'  => -1,
            'post_type'       => 'derbyfaq',
            'order'           => 'ASC',
            );
// query
        $the_query = new WP_Query( $args );
        ?>
        <div class="shawns-faq-widget">
            <?php if( $the_query->have_posts() ): ?>
                <ul class="accordion" data-accordion data-allow-all-closed="true">
                <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                    <li class="accordion-item" data-accordion-item>
                      <a href="#" class="accordion-title"><?php the_title();?></a>
                      <div class="accordion-content" data-tab-content>
                        <?php the_content();?>
                      </div>
                    </li>
                <?php endwhile; ?>
                </ul>
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
add_action('widgets_init', create_function('', 'return register_widget("derby_faq_widget");'));
?>