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


function wpsm_faq_header_info() {
 	if(get_post_type()=="wpsm_faq_r") {
		?>
		<style>
		.wpsm_ac_h_i{
			background:url('<?php echo wpshopmart_faq_directory_url.'assets/images/slideshow-01.jpg'; ?>') 50% 0 repeat fixed;
			
			
			margin-left: -20px;
			font-family: Myriad Pro ;
			cursor: pointer;
			text-align: center;
		}
		.wpsm_ac_h_i .wpsm_ac_h_b{
			color: white;
			font-size: 30px;
			font-weight: bolder;
			padding: 0 0 15px 0;
		}
		.wpsm_ac_h_i .wpsm_ac_h_b .dashicons{
			font-size: 40px;
			position: absolute;
			margin-left: -45px;
			margin-top: -10px;
		}
		 .wpsm_ac_h_small{
			font-weight: bolder;
			color: white;
			font-size: 18px;
			padding: 0 0 15px 15px;
		}

		.wpsm_ac_h_i a{
		text-decoration: none;
		}
		@media screen and ( max-width: 600px ) {
			.wpsm_ac_h_i{ padding-top: 60px; margin-bottom: -50px; }
			.wpsm_ac_h_i .WlTSmall { display: none; }
		}
		.texture-layer {
			background: rgba(0,0,0,0.7);
    padding-top: 0px;
	padding: 27px 0 23px 0;
		}
		.wpsm_ac_h_i  li {
			
			color:#fff;
			font-size: 17px;
			line-height: 1.3;
			font-weight: 600;
			
		}
		 
		  .wpsm_ac_h_i .btn-danger{
			      font-size: 29px;
				  background-color: #E74B42;
				  border-radius:1px;
				  margin-right:10px;
				 
		  }
		  .wpsm_ac_h_i .btn-success{
			      font-size: 29px;
				  border-radius:1px;
		  }
		</style>
		<div class="wpsm_ac_h_i ">
			<div class="texture-layer">
				
					<div class="wpsm_ac_h_b"><a class="btn btn-danger btn-lg " href="http://wpshopmart.com/plugins/accordion-pro/" target="_blank">Get Accordion/Faq Pro Only In $6</a><a class="btn btn-success btn-lg " href="http://demo.wpshopmart.com/accordion-pro/" target="_blank">View Demo</a></div>
					<div style="overflow:hidden;display:block;width:100%">
						<div class="col-md-3">
							<a href="http://wpshopmart.com/plugins/accordion-pro/" target="_blank">
								<ul>
									<li> 8 Design Templates </li>
									<li> 30 Content Animations </li>
									<li> 12 Open/close Icons Set </li>
									<li> 4 Overlay Effect </li>
								</ul>
							</a>
						</div>
						<div class="col-md-3">
							<a href="http://wpshopmart.com/plugins/accordion-pro/" target="_blank">
								<ul>
									<li> 500+ Google Fonts </li>
									<li> Accordion Scroll Effect </li>
									<li> On Hover Accordion </li>
									<li> Widget Option </li>
								</ul>
							</a>	
						</div>
						<div class="col-md-3">
							<a href="http://wpshopmart.com/plugins/accordion-pro/" target="_blank">
								<ul>
									<li> Unlimited Shortcode </li>
									<li> Unlimited Color Scheme </li>
									<li> Drag And Drop Builder </li>
									<li> Preview Option </li>
								</ul>
							</a>	
						</div>
						<div class="col-md-3">
							<a href="http://wpshopmart.com/plugins/accordion-pro/" target="_blank">
								<ul>
									<li> Collapse Mode </li>
									<li> Border Color Customization </li>
									<li> High Priority Support </li>
									<li> All Browser Compatible </li>
								</ul>
							</a>	
						</div>
					</div>
				
			</div>
		</div>
		<?php  
	}
}
add_action('in_admin_header','wpsm_faq_header_info'); 

?>