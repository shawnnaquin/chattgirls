<?php 
add_action('plugins_loaded', 'wpsm_faq_tr');
function wpsm_faq_tr() {
	load_plugin_textdomain( wpshopmart_faq_text_domain, FALSE, dirname( plugin_basename(__FILE__)).'/languages/' );
}

function wpsm_faq_front_script() {
    
		wp_enqueue_script('jquery');
		
		//font awesome css
		wp_enqueue_style('wpsm_faq-font-awesome-front', wpshopmart_faq_directory_url.'assets/css/font-awesome/css/font-awesome.min.css');
		wp_enqueue_style('wpsm_faq_bootstrap-front', wpshopmart_faq_directory_url.'assets/css/bootstrap-front.css');
		
		wp_enqueue_script( 'wpsm_faq_bootstrap-js-front', wpshopmart_faq_directory_url.'assets/js/bootstrap.js', array(), '', true );
		wp_enqueue_script( 'call_faq-js-front', wpshopmart_faq_directory_url.'assets/js/accordion.js', array(), '', true );

}

add_action( 'wp_enqueue_scripts', 'wpsm_faq_front_script' );
add_filter( 'widget_text', 'do_shortcode');





add_action('media_buttons_context', 'wpsm_faq_editor_popup_content_button');
add_action('admin_footer', 'wpsm_faq_editor_popup_content');

function wpsm_faq_editor_popup_content_button($context) {
 $img = wpshopmart_faq_directory_url.'assets/images/icon.png';
  $container_id = 'WPSM_FAQ';
  $title = 'Select FAQ to insert into post';
  $context .= '<style>.wp_faq_shortcode_button {
				background: #777777 !important;
				border-color: #777777 #777777 #777777 !important;
				-webkit-box-shadow: 0 1px 0 #777777 !important;
				box-shadow: 0 1px 0 #777777 !important;
				color: #fff;
				text-decoration: none;
				text-shadow: 0 -1px 1px #777777 ,1px 0 1px #777777,0 1px 1px #11CAA5,-1px 0 1px #11CAA5 !important;
			    }</style>
			    <a class="button button-primary wp_faq_shortcode_button thickbox" title="Select Faq to insert into post"    href="#TB_inline?width=400&inlineId='.$container_id.'">
					<span class="wp-media-buttons-icon" style="background: url('.$img.'); background-repeat: no-repeat; background-position: left bottom;"></span>
				Faq Shortcode
				</a>';
  return $context;
}

function wpsm_faq_editor_popup_content() {
	?>
	<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery('#wpsm_faq_insert').on('click', function() {
			var id = jQuery('#wpsm_faq_insertselect option:selected').val();
			window.send_to_editor('<p>[WPSM_FAQ id=' + id + ']</p>');
			tb_remove();
		})
	});
	</script>
<style>
.wp_faq_shortcode_button {
    background: #777777; !important;
    border-color: #777777; #777777 #777777 !important;
    -webkit-box-shadow: 0 1px 0 #777777 !important;
    box-shadow: 0 1px 0 #777777 !important;
    color: #fff !important;
    text-decoration: none;
    text-shadow: 0 -1px 1px #777777 ,1px 0 1px #777777,0 1px 1px #777777,-1px 0 1px #11CAA5 !important;
}
</style>
	<div id="WPSM_FAQ" style="display:none;">
	  <h3>Select FAQ To Insert Into Post</h3>
	  <?php 
		
		$all_posts = wp_count_posts( 'wpsm_faq_r')->publish;
		$args = array('post_type' => 'wpsm_faq_r', 'posts_per_page' =>$all_posts);
		global $All_rac;
		$All_rac = new WP_Query( $args );			
		if( $All_rac->have_posts() ) { ?>	
			<select id="wpsm_faq_insertselect" style="width: 100%;margin-bottom: 20px;">
				<?php
				while ( $All_rac->have_posts() ) : $All_rac->the_post(); ?>
				<?php $title = get_the_title(); ?>
				<option value="<?php echo get_the_ID(); ?>"><?php if (strlen($title) == 0) echo 'No Title Found'; else echo $title;   ?></option>
				<?php
				endwhile; 
				?>
			</select>
			<button class='button primary wp_faq_shortcode_button' id='wpsm_faq_insert'><?php _e('Insert Faq Shortcode', wpshopmart_faq_text_domain); ?></button>
			<?php
		} else {
			_e('No Faq Found', wpshopmart_faq_text_domain);
		}
		?>
	</div>
	<?php
}
?>