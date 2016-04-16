<?php
class wpsm_faq {
	private static $instance;
    public static function forge() {
        if (!isset(self::$instance)) {
            $className = __CLASS__;
            self::$instance = new $className;
        }
        return self::$instance;
    }
	
	private function __construct() {
		add_action('admin_enqueue_scripts', array(&$this, 'wpsm_faq_admin_scripts'));
        if (is_admin()) {
			add_action('init', array(&$this, 'wpsm_faq_register_cpt'), 1);
			add_action('add_meta_boxes', array(&$this, 'wpsm_faq_meta_boxes_group'));
			add_action('admin_init', array(&$this, 'wpsm_faq_meta_boxes_group'), 1);
			add_action('save_post', array(&$this, 'add_faq_meta_box_save'), 9, 1);
			add_action('save_post', array(&$this, 'faq_settings_meta_box_save'), 9, 1);
		}
    }
	
	// admin scripts
	public function wpsm_faq_admin_scripts(){
		if(get_post_type()=="wpsm_faq_r"){
			
			wp_enqueue_media();
			wp_enqueue_script('jquery-ui-datepicker');
			//color-picker css n js
			wp_enqueue_style( 'wp-color-picker' );
			wp_enqueue_script( 'wpsm_faq_sh-color-pic', wpshopmart_faq_directory_url.'assets/js/color-picker.js', array( 'wp-color-picker' ), false, true );
			 wp_enqueue_style('wpsm_faq_sh-panel-style', wpshopmart_faq_directory_url.'assets/css/panel-style.css');
			  
			//font awesome css
			wp_enqueue_style('wpsm_faq_sh-font-awesome', wpshopmart_faq_directory_url.'assets/css/font-awesome/css/font-awesome.min.css');
			wp_enqueue_style('wpsm_faq_sh_bootstrap', wpshopmart_faq_directory_url.'assets/css/bootstrap.css');
			wp_enqueue_style('wpsm_faq_sh_font-awesome-picker', wpshopmart_faq_directory_url.'assets/css/fontawesome-iconpicker.css');
			wp_enqueue_style('faq_jquery-css', wpshopmart_faq_directory_url .'assets/css/ac_jquery-ui.css');
			
			//line editor
			wp_enqueue_style('wpsm_faq_sh_line-edtor', wpshopmart_faq_directory_url.'assets/css/jquery-linedtextarea.css');
			wp_enqueue_script( 'wpsm_faq_sh-line-edit-js', wpshopmart_faq_directory_url.'assets/js/jquery-linedtextarea.js');
			
			wp_enqueue_script( 'wpsm_faq_sh-bootstrap-js', wpshopmart_faq_directory_url.'assets/js/bootstrap.js');
			
			//tooltip
			wp_enqueue_style('wpsm_faq_sh_tooltip', wpshopmart_faq_directory_url.'assets/tooltip/darktooltip.css');
			wp_enqueue_script( 'wpsm_faq_sh-tooltip-js', wpshopmart_faq_directory_url.'assets/tooltip/jquery.darktooltip.js');
			// settings
			wp_enqueue_style('wpsm_faq_sh_settings-css', wpshopmart_faq_directory_url.'assets/css/settings.css');
			wp_enqueue_script('faq_sh_font-icon-picker-js', wpshopmart_faq_directory_url.'assets/js/fontawesome-iconpicker.js',array('jquery'));
			wp_enqueue_script('faq_sh_call-icon-picker-js', wpshopmart_faq_directory_url.'assets/js/call-icon-picker.js',array('jquery'), false, true);
		
			}
	}
	
	public function wpsm_faq_register_cpt(){
		require_once('cpt-reg.php');
		add_filter( 'manage_edit-wpsm_faq_r_columns', array(&$this, 'faq_panels_columns' )) ;
		add_action( 'manage_wpsm_faq_r_posts_custom_column', array(&$this, 'faq_panels_manage_columns' ), 10, 2 );
	}
	
	function faq_panels_columns( $columns ){
        $columns = array(
            'cb' => '<input type="checkbox" />',
            'title' => __( 'Faq' ),
            'shortcode' => __( 'Faq Shortcode' ),
            'date' => __( 'Date' )
        );
        return $columns;
    }

    function faq_panels_manage_columns( $column, $post_id ){
        global $post;
        switch( $column ) {
          case 'shortcode' :
            echo '<input style="width:225px" type="text" value="[WPSM_FAQ id='.$post_id.']" readonly="readonly" />';
            break;
          default :
            break;
        }
    }
	
	// metaboxes
	public function wpsm_faq_meta_boxes_group(){
		add_meta_box('add_faq', __('Add Faq Panel', wpshopmart_faq_text_domain), array(&$this, 'wpsm_add_faq_meta_box_function'), 'wpsm_faq_r', 'normal', 'low' );
		add_meta_box ('faq_shortcode', __('Faq Shortcode', wpshopmart_faq_text_domain), array(&$this, 'wpsm_pic_faq_shortcode'), 'wpsm_faq_r', 'normal', 'low');
		add_meta_box('faq_rateus', __('Rate Us If You Like This Plugin', wpshopmart_faq_text_domain), array(&$this, 'wpsm_faq_rateus_meta_box_function'), 'wpsm_faq_r', 'side', 'low');
		add_meta_box('faq_setting', __('Faq Settings', wpshopmart_faq_text_domain), array(&$this, 'wpsm_add_faq_setting_meta_box_function'), 'wpsm_faq_r', 'side', 'low');
	}
	
	public function wpsm_add_faq_meta_box_function($post){
		require_once('add-faq.php');
	}
	
	public function wpsm_pic_faq_shortcode(){
		?>
		<style>
			#faq_shortcode{
			background:#fff!important;
			box-shadow: 0 0 20px rgba(0,0,0,.2);
			}
			#faq_shortcode .hndle , #faq_shortcode .handlediv{
			display:none;
			}
			#faq_shortcode p{
			color:#000;
			font-size:15px;
			}
			#faq_shortcode input {
			font-size: 16px;
			padding: 8px 10px;
			width:100%;
			}
			
			
		</style>
		<h3>Faq Shortcode</h3>
		<p><?php _e("Use below shortcode in any Page/Post to publish your FAQ", wpshopmart_faq_text_domain);?></p>
		<input readonly="readonly" type="text" value="<?php echo "[WPSM_FAQ id=".get_the_ID()."]"; ?>">
		<?php
		 $PostId = get_the_ID();
		$Settings = unserialize(get_post_meta( $PostId, 'Wpsm_Faq_Shortcode_Settings', true));
		if(isset($Settings['custom_css'])){  
		     $custom_css   = $Settings['custom_css'];
		}
		else{
		$custom_css="";
		}		
		?>
			<div>
			<h3>To activate widget into any widget area</H3>
			<p><a href="<?php get_site_url();?>./widgets.php" >Click Here</a>. </p>
			<p>Find <b>FAQ Widget </b> and place it to your widget area. Select any FAQ from the list and then save changes.</p>
		</div>	
		
		<h3>Custom Css</h3>
		<textarea name="custom_css" id="custom_css" style="width:100% !important ;height:300px;background:#ECECEC;"><?php echo $custom_css ; ?></textarea>
		<p>Enter Css without <strong>&lt;style&gt; &lt;/style&gt; </strong> tag</p>
		<br>
		<?php if(isset($Settings['custom_css'])){ ?> 
		<h3>Add This FAQ settings as default setting for new FAQs</h3>
		<div class="">
			<a  class="button button-primary button-hero" name="updte_wpsm_faq_default_settings" id="updte_wpsm_faq_default_settings" onclick="wpsm_update_default()">Update Default Settings</a>
		</div>	
		<?php } ?>
		<?php 
	}
	
	public function wpsm_faq_rateus_meta_box_function(){
		?>
		<style>
		#faq_rateus{
			background:url(<?php echo wpshopmart_faq_directory_url.'assets/images/rate-bg.jpg'; ?>)!important;
			}
			#faq_rateus .hndle , #faq_rateus .handlediv{
			display:none;
			}
			#faq_rateus h1{
			color:#fff;
			
			}
			 #faq_rateus h3 {
			color:#fff;
			font-size:15px;
			}
			#faq_rateus .button-hero{
			display:block;
			text-align:center;
			margin-bottom:15px;
			}
			.wpsm-rate-us{
			text-align:center;
			}
			.wpsm-rate-us span.dashicons {
				width: 40px;
				height: 40px;
				font-size:20px;
				color : #ffffff !important;
			}
			.wpsm-rate-us span.dashicons-star-filled:before {
				content: "\f155";
				font-size: 40px;
			}
		</style>
		   <h1>Rate Us </h1>
			<h3>Show us some love, If you like our product then please give us some valuable feedback on wordpress</h3>
			<a href="https://wordpress.org/plugins/faq-responsive/" target="_blank" class="button button-primary button-hero ">RATE HERE</a>
			<a class="wpsm-rate-us" style=" text-decoration: none; height: 40px; width: 40px;" href="https://wordpress.org/plugins/faq-responsive/" target="_blank">
				<span class="dashicons dashicons-star-filled"></span>
				<span class="dashicons dashicons-star-filled"></span>
				<span class="dashicons dashicons-star-filled"></span>
				<span class="dashicons dashicons-star-filled"></span>
				<span class="dashicons dashicons-star-filled"></span>
			</a>
		<?php 
	}
	
	public function wpsm_add_faq_setting_meta_box_function($post){
		require_once('settings.php');
	}
	
	public function add_faq_meta_box_save($PostID) {
		require('data-post/faq-save-data.php');
    }
	
	public function faq_settings_meta_box_save($PostID){
		require('data-post/faq-settings-save-data.php');
	}
	
	
}
global $wpsm_faq;
$wpsm_faq = wpsm_faq::forge();

 ?>