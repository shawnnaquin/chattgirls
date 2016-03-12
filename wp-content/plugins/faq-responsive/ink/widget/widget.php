<?php
/**
 * Adds  widget.
 */
class Wpsm_Faq_Widget extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    function __construct() {
        parent::__construct(
            'wpsm_faq_widget_is', // Base ID
            'Faq Widget', // Name
            array( 'description' => __( 'Display Your FAQ in widget area.', wpshopmart_faq_text_domain ), ) // Args
        );
	}

    /**
     * Front-end display of widget.
     */
    public function widget( $args, $instance ) {
        $Title    	=   apply_filters( 'wpsm_faq_widget_title', $instance['Title'] );
		echo $args['before_widget'];
		
		 $wpsm_faq_id	=   apply_filters( 'wpsm_faq_widget_shortcode', $instance['Shortcode'] ); 

		if(is_numeric($wpsm_faq_id)) {
			if ( ! empty( $instance['Title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['Title'] ). $args['after_title'];
			}
			echo do_shortcode( '[WPSM_FAQ id='.$wpsm_faq_id.']' );
		} else {
			echo "<p>Sorry! No FAQ Shortcode Found.</p>";
		}
		echo $args['after_widget'];
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form( $instance ) {

        if ( isset( $instance[ 'Title' ] ) ) {
            $Title = $instance[ 'Title' ];
        } else {
            $Title = "FAQ Shortcode";
        }

        if ( isset( $instance[ 'Shortcode' ] ) ) {
            $Shortcode = $instance[ 'Shortcode' ];
        } else {
            $Shortcode = "Select Any FAQ";
        }
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'Title' ); ?>"><?php _e( 'Widget Title' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'Title' ); ?>" name="<?php echo $this->get_field_name( 'Title' ); ?>" type="text" value="<?php echo esc_attr( $Title ); ?>">
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'Shortcode' ); ?>"><?php _e( 'Select FAQ' ); ?> (Required)</label>
			<?php
			/**
			 * Get All FAQ Shortcode Custom Post Type
			 */
			$wpsm_faq_cpt = "wpsm_faq_r";
			global $All_Wpsm_FAQ;
			$All_Wpsm_FAQ = array('post_type' => $wpsm_faq_cpt, 'orderby' => 'ASC', 'post_status' => 'publish');
			$All_Wpsm_FAQ = new WP_Query( $All_Wpsm_FAQ );		
			?>
			<select id="<?php echo $this->get_field_id( 'Shortcode' ); ?>" name="<?php echo $this->get_field_name( 'Shortcode' ); ?>" style="width: 100%;">
				<option value="Select Any FAQ" <?php if($Shortcode == "Select Any FAQ") echo 'selected="selected"'; ?>>Select Any FAQ</option>
				<?php
				if( $All_Wpsm_FAQ->have_posts() ) {	 ?>	
				<?php while ( $All_Wpsm_FAQ->have_posts() ) : $All_Wpsm_FAQ->the_post();	
					$PostId = get_the_ID(); 
					$PostTitle = get_the_title($PostId);
				?>
				<option value="<?php echo $PostId; ?>" <?php if($Shortcode == $PostId) echo 'selected="selected"'; ?>><?php if($PostTitle) echo $PostTitle; else _e("No Title", wpshopmart_faq_text_domain); ?></option>
				<?php endwhile; ?>
				<?php
			}  else  { 
				echo "<option>Sorry! No FAQ Shortcode Found.</option>";
			}
			?>
			</select>
        </p>
        <?php
    }

    /**
     * Sanitize widget form values as they are saved.
     */
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['Title'] = ( ! empty( $new_instance['Title'] ) ) ? strip_tags( $new_instance['Title'] ) : '';
        $instance['Shortcode'] = ( ! empty( $new_instance['Shortcode'] ) ) ? strip_tags( $new_instance['Shortcode'] ) : 'Select Any FAQ';
        
        return $instance;
    }
} // end of  Widget Class

// Register Widget
function Wpsm_Faq_Widget() {
    register_widget( 'Wpsm_Faq_Widget' );
}
add_action( 'widgets_init', 'Wpsm_Faq_Widget' );
?>