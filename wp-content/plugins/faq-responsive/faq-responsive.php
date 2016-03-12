<?php
/**
 * Plugin Name: Faq Responsive
 * Version: 1.1
 * Description:  Most easiest drag & drop FAQ builder for WordPress. You can generate Unlimited FAQ with unlimited colour scheme.
 * Author: wpshopmart
 * Author URI: http://www.wpshopmart.com
 * Plugin URI: http://www.wpshopmart.com
 */
 /**
 * DEFINE PATHS
 */
define("wpshopmart_faq_directory_url", plugin_dir_url(__FILE__));
define("wpshopmart_faq_text_domain", "wpsm_faq");

/**
 * PLUGIN Install
 */
require_once("ink/install/installation.php");

function wpsm_faq_default_data() {
	
			$Settings_Array = serialize( array(
				"acc_sec_title" 	 => "yes",
				"op_cl_icon" 		 => "1",
				"acc_title_icon"     => "no",
				"acc_radius"      	 => "yes",
				"acc_margin"   		 => "yes",
				"enable_toggle"    	 => "no",
				"enable_ac_border"   => "yes",
				"acc_op_cl_align"    => "left",
				"acc_title_bg_clr"   => "#ffffff",
				"acc_title_icon_clr" => "#000000",
				"acc_open_cl_icon_bg_clr" => "#dd3333",
				"acc_open_cl_icon_ft_clr" => "#ffffff",
				"acc_desc_bg_clr"    => "#ffffff",
				"acc_desc_font_clr"  => "#000000",
				"title_size"         => "18",
				"des_size"     		 => "16",
				"font_family"     	 => "Open Sans",
				"expand_option"      =>1,
				"ac_styles"      =>1,
				"custom_css"      =>"",
				) );

			add_option('faq_default_Settings', $Settings_Array);
}
register_activation_hook( __FILE__, 'wpsm_faq_default_data' );
 
/**
 * CPT CLASS
 */
require_once("ink/admin/menu.php");
/**
 * SHORTCODE
 */
 
require_once("template/shortcode.php"); 
require_once("ink/widget/widget.php"); 

?>