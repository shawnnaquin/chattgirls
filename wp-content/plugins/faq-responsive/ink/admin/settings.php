<?php 
$De_Settings = unserialize(get_option('faq_default_Settings'));
 $PostId = $post->ID;
 $Settings = unserialize(get_post_meta( $PostId, 'Wpsm_Faq_Shortcode_Settings', true));

		$option_names = array(
			"acc_sec_title" 	 => $De_Settings['acc_sec_title'],
			"op_cl_icon" 		 => $De_Settings['op_cl_icon'],
			"acc_title_icon"     => $De_Settings['acc_title_icon'],
			"acc_radius"      	 => $De_Settings['acc_radius'],
			"acc_margin"   		 => $De_Settings['acc_margin'],
			"enable_toggle"    	 => $De_Settings['enable_toggle'],
			"enable_ac_border"   => $De_Settings['enable_ac_border'],
			"acc_op_cl_align"    => $De_Settings['acc_op_cl_align'],
			"acc_title_bg_clr"   => $De_Settings['acc_title_bg_clr'],
			"acc_title_icon_clr" => $De_Settings['acc_title_icon_clr'],
			"acc_open_cl_icon_bg_clr" => $De_Settings['acc_open_cl_icon_bg_clr'],
			"acc_open_cl_icon_ft_clr" => $De_Settings['acc_open_cl_icon_ft_clr'],
			"acc_desc_bg_clr"    => $De_Settings['acc_desc_bg_clr'],
			"acc_desc_font_clr"  => $De_Settings['acc_desc_font_clr'],
			"title_size"         => $De_Settings['title_size'],
			"des_size"     		 => $De_Settings['des_size'],
			"font_family"     	 => $De_Settings['font_family'],
			"expand_option"      =>$De_Settings['expand_option'],
			"ac_styles"      =>$De_Settings['ac_styles'],
			"custom_css"      =>$De_Settings['custom_css'],
			);
			foreach($option_names as $option_name => $default_value) {
				if(isset($Settings[$option_name])) 
					${"" . $option_name}  = $Settings[$option_name];
				else
					${"" . $option_name}  = $default_value;
			}


			
		?>
<style>

</style>
<Script>

 //font slider size script
  jQuery(function() {
    jQuery( "#title_size_id" ).slider({
		orientation: "horizontal",
		range: "min",
		max: 30,
		min:5,
		slide: function( event, ui ) {
		jQuery( "#title_size" ).val( ui.value );
      }
		});
		
		jQuery( "#title_size_id" ).slider("value",<?php echo $title_size; ?> );
		jQuery( "#title_size" ).val( jQuery( "#title_size_id" ).slider( "value") );
    
  });
</script>
<Script>

 //font slider size script
  jQuery(function() {
    jQuery( "#des_size_id" ).slider({
		orientation: "horizontal",
		range: "min",
		max: 30,
		min:5,
		slide: function( event, ui ) {
		jQuery( "#des_size" ).val( ui.value );
      }
		});
		
		jQuery( "#des_size_id" ).slider("value",<?php echo $des_size; ?>);
		jQuery( "#des_size" ).val( jQuery( "#des_size_id" ).slider( "value") );
    
  });
</script> 
<Script>
function wpsm_update_default(){
	 jQuery.ajax({
		url: location.href,
		type: "POST",
		data : {
			    'action_faq':'default_settins_action',
			     },
                success : function(data){
									alert("Default Settings Updated");
									location.reload(true);
                                   }	
	});
	
}
</script>
<?php

if(isset($_POST['action_faq']) == "default_settins_action")
	{
	
		$Settings_Array2 = serialize( array(
			"acc_sec_title" 	 => $acc_sec_title,
			"op_cl_icon" 		 => $op_cl_icon,
			"acc_title_icon"     => $acc_title_icon,
			"acc_radius"      	 => $acc_radius,
			"acc_margin"   		 => $acc_margin,
			"enable_toggle"    	 => $enable_toggle,
			"enable_ac_border"   => $enable_ac_border,
			"acc_op_cl_align"    => $acc_op_cl_align,
			"acc_title_bg_clr"   => $acc_title_bg_clr,
			"acc_title_icon_clr" => $acc_title_icon_clr,
			"acc_open_cl_icon_bg_clr" => $acc_open_cl_icon_bg_clr,
			"acc_open_cl_icon_ft_clr" => $acc_open_cl_icon_ft_clr,
			"acc_desc_bg_clr"    => $acc_desc_bg_clr,
			"acc_desc_font_clr"  => $acc_desc_font_clr,
			"title_size"         => $title_size,
			"des_size"     		 => $des_size,
			"font_family"     	 => $font_family,
			"expand_option"      =>$expand_option,
			"ac_styles"      => $ac_styles,
			"custom_css"      => $custom_css,
				) );

			update_option('faq_default_Settings', $Settings_Array2);
}

 ?> 
<input type="hidden" id="wpsm_faq_setting_save_action" name="wpsm_faq_setting_save_action" value="wpsm_faq_setting_save_action">
		
<table class="form-table acc_table">
	<tbody>
		
		<tr>
			<th scope="row"><label><?php _e('Display Faq Section Title ',wpshopmart_faq_text_domain); ?></label>
			<a  class="ac_tooltip" href="#help" data-tooltip="#acc_sec_title_tp"><i class="fa fa-lightbulb-o"></i></a>
				</th>
			<td>
				<div class="switch">
					<input type="radio" class="switch-input" name="acc_sec_title" value="yes" id="enable_acc_sec_title" <?php if($acc_sec_title == 'yes' ) { echo "checked"; } ?>   >
					<label for="enable_acc_sec_title" class="switch-label switch-label-off"><?php _e('Yes',wpshopmart_faq_text_domain); ?></label>
					<input type="radio" class="switch-input" name="acc_sec_title" value="no" id="disable_acc_sec_title"  <?php if($acc_sec_title == 'no' ) { echo "checked"; } ?> >
					<label for="disable_acc_sec_title" class="switch-label switch-label-on"><?php _e('No',wpshopmart_faq_text_domain); ?></label>
					<span class="switch-selection"></span>
				</div>
				<!-- Tooltip -->
				<div id="acc_sec_title_tp" style="display:none;">
					<div style="color:#fff !important;padding:10px;">
						<h2 style="color:#fff !important;"><?php _e('Display Faq Section Title ',wpshopmart_faq_text_domain); ?></h2>
							<img src="<?php echo wpshopmart_faq_directory_url.'assets/tooltip/img/faq-section.png'; ?>">
					
					</div>
		    	</div>
			</td>
		</tr>
		
		
		<tr>
			<th scope="row"><label><?php _e('Display Open Close Icon ',wpshopmart_faq_text_domain); ?></label>
			<a  class="ac_tooltip" href="#help" data-tooltip="#op_cl_icon_tp"><i class="fa fa-lightbulb-o"></i></a>
				
			</th>
			<td>
				
				<span style="display:block;margin-bottom:10px"><input type="radio" name="op_cl_icon" id="op_cl_icon" value="1" <?php if($op_cl_icon == '1' ) { echo "checked"; } ?> /> Display Open Close Icon Only </span>
				<span style="display:block;margin-bottom:10px"><input type="radio" name="op_cl_icon" id="op_cl_icon" value="2" <?php if($op_cl_icon == '2' ) { echo "checked"; } ?>  /> Display Number Only </span>
				<span style="display:block"><input type="radio" name="op_cl_icon" id="op_cl_icon" value="3"  <?php if($op_cl_icon == '3' ) { echo "checked"; } ?> /> Hide Both </span>
				
				
				<!-- Tooltip -->
				<div id="op_cl_icon_tp" style="display:none;">
					<div style="color:#fff !important;padding:10px;">
						<h2 style="color:#fff !important;"><?php _e('Display Open Close Icon ',wpshopmart_faq_text_domain); ?></h2>
						<img src="<?php echo wpshopmart_faq_directory_url.'assets/tooltip/img/faq-title.png'; ?>">
					
					</div>
		    	</div>
			</td>
		</tr>
		
		<tr>
			<th scope="row"><label><?php _e('Display Faq Title Font Icon ',wpshopmart_faq_text_domain); ?></label>
			<a  class="ac_tooltip" href="#help" data-tooltip="#acc_title_icon_tp"><i class="fa fa-lightbulb-o"></i></a>
			</th>
			<td>
				<div class="switch">
					<input type="radio" class="switch-input" name="acc_title_icon" value="yes" id="enable_acc_title_icon" <?php if($acc_title_icon == 'yes' ) { echo "checked"; } ?>  >
					<label for="enable_acc_title_icon" class="switch-label switch-label-off"><?php _e('Yes',wpshopmart_faq_text_domain); ?></label>
					<input type="radio" class="switch-input" name="acc_title_icon" value="no" id="disable_acc_title_icon" <?php if($acc_title_icon == 'no' ) { echo "checked"; } ?> >
					<label for="disable_acc_title_icon" class="switch-label switch-label-on"><?php _e('No',wpshopmart_faq_text_domain); ?></label>
					<span class="switch-selection"></span>
				</div>
				<!-- Tooltip -->
				<div id="acc_title_icon_tp" style="display:none;">
					<div style="color:#fff !important;padding:10px;">
						<h2 style="color:#fff !important;"><?php _e('Display Faq Title Font Icon ',wpshopmart_faq_text_domain); ?></h2>
					</div>
		    	</div>
			</td>
		</tr>
		
		<tr>
			<th scope="row"><label><?php _e('Enable Faq Radius ',wpshopmart_faq_text_domain); ?></label>
			<a  class="ac_tooltip" href="#help" data-tooltip="#acc_radius_tp"><i class="fa fa-lightbulb-o"></i></a>
				
			</th>
			<td>
				<div class="switch">
					<input type="radio" class="switch-input" name="acc_radius" value="yes" id="enable_acc_radius" <?php if($acc_radius == 'yes' ) { echo "checked"; } ?>  >
					<label for="enable_acc_radius" class="switch-label switch-label-off"><?php _e('Yes',wpshopmart_faq_text_domain); ?></label>
					<input type="radio" class="switch-input" name="acc_radius" value="no" id="disable_acc_radius" <?php if($acc_radius == 'no' ) { echo "checked"; } ?> >
					<label for="disable_acc_radius" class="switch-label switch-label-on"><?php _e('No',wpshopmart_faq_text_domain); ?></label>
					<span class="switch-selection"></span>
				</div>
				<!-- Tooltip -->
				<div id="acc_radius_tp" style="display:none;">
					<div style="color:#fff !important;padding:10px;">
						<h2 style="color:#fff !important;"><?php _e('Enable Faq Radius from here',wpshopmart_faq_text_domain); ?></h2>
					</div>
		    	</div>
			</td>
		</tr>
		
		<tr>
			<th scope="row"><label><?php _e('Faq title bottom border Enable',wpshopmart_faq_text_domain); ?></label>
			<a  class="ac_tooltip" href="#help" data-tooltip="#acc_op_cl_align_tp"><i class="fa fa-lightbulb-o"></i></a>
				
			</th>
			<td>
				<div class="switch">
					<input type="radio" class="switch-input" name="enable_ac_border" value="yes" id="enable_enable_ac_border" <?php if($enable_ac_border == 'yes' ) { echo "checked"; } ?>  >
					<label for="enable_enable_ac_border" class="switch-label switch-label-off"><?php _e('Yes',wpshopmart_faq_text_domain); ?></label>
					<input type="radio" class="switch-input" name="enable_ac_border" value="no" id="disable_enable_ac_border" <?php if($enable_ac_border == 'no' ) { echo "checked"; } ?> >
					<label for="disable_enable_ac_border" class="switch-label switch-label-on"><?php _e('No',wpshopmart_faq_text_domain); ?></label>
					<span class="switch-selection"></span>
				</div>
				<!-- Tooltip -->
				<div id="acc_op_cl_align_tp" style="display:none;">
					<div style="color:#fff !important;padding:10px;">
						<h2 style="color:#fff !important;"><?php _e('Faq Open/Close Icon Alignment',wpshopmart_faq_text_domain); ?></h2>
						<img src="<?php echo wpshopmart_faq_directory_url.'assets/tooltip/img/border.png'; ?>">
					</div>
		    	</div>
			</td>
		</tr>
		
		<tr>
			<th scope="row"><label><?php _e('Enable Faq Margin/Space',wpshopmart_faq_text_domain); ?></label>
			<a  class="ac_tooltip" href="#help" data-tooltip="#acc_margin_tp"><i class="fa fa-lightbulb-o"></i></a>
				
			</th>
			<td>
				<div class="switch">
					<input type="radio" class="switch-input" name="acc_margin" value="yes" id="enable_acc_margin" <?php if($acc_margin == 'yes' ) { echo "checked"; } ?>  >
					<label for="enable_acc_margin" class="switch-label switch-label-off"><?php _e('Yes',wpshopmart_faq_text_domain); ?></label>
					<input type="radio" class="switch-input" name="acc_margin" value="no" id="disable_acc_margin"  <?php if($acc_margin == 'no' ) { echo "checked"; } ?> >
					<label for="disable_acc_margin" class="switch-label switch-label-on"><?php _e('No',wpshopmart_faq_text_domain); ?></label>
					<span class="switch-selection"></span>
				</div>
				<!-- Tooltip -->
				<div id="acc_margin_tp" style="display:none;">
					<div style="color:#fff !important;padding:10px;">
						<h2 style="color:#fff !important;"><?php _e('Enable Faq Margin/Space',wpshopmart_faq_text_domain); ?></h2>
						<img src="<?php echo wpshopmart_faq_directory_url.'assets/tooltip/img/margin.png'; ?>">
					</div>
		    	</div>
			</td>
		</tr>
		
		<tr>
			<th scope="row"><label><?php _e('Enable Toggle/Collapse ',wpshopmart_faq_text_domain); ?></label>
			<a  class="ac_tooltip" href="#help" data-tooltip="#enable_toggle_tp"><i class="fa fa-lightbulb-o"></i></a>
				
			</th>
			<td>
				<div class="switch">
					<input type="radio" class="switch-input" name="enable_toggle" value="yes" id="enable_acc_toggle" <?php if($enable_toggle == 'yes' ) { echo "checked"; } ?>   >
					<label for="enable_acc_toggle" class="switch-label switch-label-off"><?php _e('Yes',wpshopmart_faq_text_domain); ?></label>
					<input type="radio" class="switch-input" name="enable_toggle" value="no" id="disable_acc_toggle"  <?php if($enable_toggle == 'no' ) { echo "checked"; } ?> >
					<label for="disable_acc_toggle" class="switch-label switch-label-on"><?php _e('No',wpshopmart_faq_text_domain); ?></label>
					<span class="switch-selection"></span>
				</div>
				<!-- Tooltip -->
				<div id="enable_toggle_tp" style="display:none;">
					<div style="color:#fff !important;padding:10px;">
						<h2 style="color:#fff !important;"><?php _e('Enable Toggle/Collapse ',wpshopmart_faq_text_domain); ?></strong> very html</h2>
						<img src="<?php echo wpshopmart_faq_directory_url.'assets/tooltip/img/toggle.png'; ?>">
					</div>
		    	</div>
			</td>
		</tr>
		
		
		<tr >
			<th scope="row"><label><?php _e('Faq Title Background Colour',wpshopmart_faq_text_domain); ?></label>
			<a  class="ac_tooltip" href="#help" data-tooltip="#acc_title_bg_clr_tp"><i class="fa fa-lightbulb-o"></i></a>
				
			</th>
			<td>
				<input id="acc_title_bg_clr" name="acc_title_bg_clr" type="text" value="<?php echo $acc_title_bg_clr; ?>" class="my-color-field" data-default-color="#e8e8e8" />
				<!-- Tooltip -->
				<div id="acc_title_bg_clr_tp" style="display:none;">
					<div style="color:#fff !important;padding:10px;">
						<h2 style="color:#fff !important;"><?php _e('Faq Title Background Colour',wpshopmart_faq_text_domain); ?></h2>
						<img src="<?php echo wpshopmart_faq_directory_url.'assets/tooltip/img/title-bg-color.png'; ?>">
					</div>
		    	</div>
			</td>
		</tr>
		
		<tr >
			<th scope="row"><label><?php _e('Faq Title/Icon Font Colour',wpshopmart_faq_text_domain); ?></label>
			<a  class="ac_tooltip" href="#help" data-tooltip="#acc_title_icon_clr_tp"><i class="fa fa-lightbulb-o"></i></a>
				
			</th>
			<td>
				<input id="acc_title_icon_clr" name="acc_title_icon_clr" type="text" value="<?php echo $acc_title_icon_clr; ?>" class="my-color-field" data-default-color="#ffffff" />
				<!-- Tooltip -->
				<div id="acc_title_icon_clr_tp" style="display:none;">
					<div style="color:#fff !important;padding:10px;">
						<h2 style="color:#fff !important;"><?php _e('Faq Title/Icon Font Colour',wpshopmart_faq_text_domain); ?></h2>
						<img src="<?php echo wpshopmart_faq_directory_url.'assets/tooltip/img/title-color.png'; ?>">
					</div>
		    	</div>
			</td>
		</tr>
		
		<tr >
			<th scope="row"><label><?php _e('Faq Open/Close Icon Background Colour',wpshopmart_faq_text_domain); ?></label>
			<a  class="ac_tooltip" href="#help" data-tooltip="#acc_open_cl_icon_bg_clr_tp"><i class="fa fa-lightbulb-o"></i></a>
				
			</th>
			<td>
				<input id="acc_open_cl_icon_bg_clr" name="acc_open_cl_icon_bg_clr" type="text" value="<?php echo $acc_open_cl_icon_bg_clr; ?>" class="my-color-field" data-default-color="#dd3333" />
				<!-- Tooltip -->
				<div id="acc_open_cl_icon_bg_clr_tp" style="display:none;">
					<div style="color:#fff !important;padding:10px;">
						<h2 style="color:#fff !important;"><?php _e('Faq Title/Icon Font Colour',wpshopmart_faq_text_domain); ?></h2>
						<img src="<?php echo wpshopmart_faq_directory_url.'assets/tooltip/img/iocn-bg-color.png'; ?>">
					</div>
		    	</div>
			</td>
		</tr>
		
		<tr >
			<th scope="row"><label><?php _e('Faq Open/close Icon Font Colour',wpshopmart_faq_text_domain); ?></label>
			<a  class="ac_tooltip" href="#help" data-tooltip="#acc_open_cl_icon_ft_clr_tp"><i class="fa fa-lightbulb-o"></i></a>
				
			</th>
			<td>
				<input id="acc_open_cl_icon_ft_clr" name="acc_open_cl_icon_ft_clr" type="text" value="<?php echo $acc_open_cl_icon_ft_clr; ?>" class="my-color-field" data-default-color="#ffffff" />
				<!-- Tooltip -->
				<div id="acc_open_cl_icon_ft_clr_tp" style="display:none;">
					<div style="color:#fff !important;padding:10px;">
						<h2 style="color:#fff !important;"><?php _e('Faq Title/Icon Font Colour',wpshopmart_faq_text_domain); ?></h2>
						<img src="<?php echo wpshopmart_faq_directory_url.'assets/tooltip/img/icon-color.png'; ?>">
					</div>
		    	</div>
			</td>
		</tr>
		
		
		
		<tr >
			<th scope="row"><label><?php _e('Faq Description Background Colour',wpshopmart_faq_text_domain); ?></label>
			<a  class="ac_tooltip" href="#help" data-tooltip="#acc_desc_bg_clr_tp"><i class="fa fa-lightbulb-o"></i></a>
				
			</th>
			<td>
				<input id="acc_desc_bg_clr" name="acc_desc_bg_clr" type="text" value="<?php echo $acc_desc_bg_clr; ?>" class="my-color-field" data-default-color="#ffffff" />
				<!-- Tooltip -->
				<div id="acc_desc_bg_clr_tp" style="display:none;">
					<div style="color:#fff !important;padding:10px;">
						<h2 style="color:#fff !important;"><?php _e('Faq Description Background Colour',wpshopmart_faq_text_domain); ?></h2>
						<img src="<?php echo wpshopmart_faq_directory_url.'assets/tooltip/img/title-color.png'; ?>">
					</div>
		    	</div>
			</td>
		</tr>
		
		<tr >
			<th scope="row"><label><?php _e('Faq Description Font Colour',wpshopmart_faq_text_domain); ?></label>
			<a  class="ac_tooltip" href="#acc_desc_font_clr_tp" data-tooltip="#acc_desc_font_clr_tp"><i class="fa fa-lightbulb-o"></i></a>
				
			</th>
			<td>
				<input id="acc_desc_font_clr" name="acc_desc_font_clr" type="text" value="<?php echo $acc_desc_font_clr; ?>" class="my-color-field" data-default-color="#000000" />
				<!-- Tooltip -->
				<div id="acc_desc_font_clr_tp" style="display:none;">
					<div style="color:#fff !important;padding:10px;">
						<h2 style="color:#fff !important;"><?php _e('Faq Description Font Colour',wpshopmart_faq_text_domain); ?></h2>
						<img src="<?php echo wpshopmart_faq_directory_url.'assets/tooltip/img/iocn-bg-color.png'; ?>">
					</div>
		    	</div>
			</td>
		</tr>
		<tr class="setting_color">
			<th><?php _e('Title/Icon Font Size',wpshopmart_faq_text_domain); ?> 
			<a  class="ac_tooltip" href="#help" data-tooltip="#title_size_tp"><i class="fa fa-lightbulb-o"></i></a>
				
			</th>
			<td>
				<div id="title_size_id" class="size-slider" ></div>
				<input type="text" class="slider-text" id="title_size" name="title_size"  readonly="readonly">
				<!-- Tooltip -->
				<div id="title_size_tp" style="display:none;">
					<div style="color:#fff !important;padding:10px;max-width: 300px;">
						<h2 style="color:#fff !important;">You can update Title and Icon Font Size from here. Just Scroll it to change size.</h2>
					
					</div>
		    	</div>
			</td>
		</tr>
		
		<tr class="setting_color">
			<th><?php _e('Description Font Size',wpshopmart_faq_text_domain); ?> 
			<a  class="ac_tooltip" href="#help" data-tooltip="#des_size_tp"><i class="fa fa-lightbulb-o"></i></a>
				
			</th>
			<td>
				<div id="des_size_id" class="size-slider" ></div>
				<input type="text" class="slider-text" id="des_size" name="des_size"  readonly="readonly">
				<!-- Tooltip -->
				<div id="des_size_tp" style="display:none;">
					<div style="color:#fff !important;padding:10px;max-width: 300px;">
						<h2 style="color:#fff !important;">You can update Description Font Size from here. Just Scroll it to change size.</h2>
						
					</div>
		    	</div>
			</td>
		</tr>
		<tr >
			<th><?php _e('Font Style/Family',wpshopmart_faq_text_domain); ?> 
			<a  class="ac_tooltip" href="#help" data-tooltip="#font_family_tp"><i class="fa fa-lightbulb-o"></i></a>
				
			</th>
			<td>
				<?php if(!isset($font_family)) $font_family = "Open Sans";?>	
				<select name="font_family" id="font_family" class="standard-dropdown" style="width:100%" >
					<optgroup label="Default Fonts">
						<option value="Arial"           <?php if($font_family == 'Arial' ) { echo "selected"; } ?>>Arial</option>
						<option value="Arial Black"    <?php if($font_family == 'Arial Black' ) { echo "selected"; } ?>>Arial Black</option>
						<option value="Courier New"     <?php if($font_family == 'Courier New' ) { echo "selected"; } ?>>Courier New</option>
						<option value="Georgia"         <?php if($font_family == 'Georgia' ) { echo "selected"; } ?>>Georgia</option>
						<option value="Grande"          <?php if($font_family == 'Grande' ) { echo "selected"; } ?>>Grande</option>
						<option value="Helvetica" 	<?php if($font_family == 'Helvetica' ) { echo "selected"; } ?>>Helvetica Neue</option>
						<option value="Impact"         <?php if($font_family == 'Impact' ) { echo "selected"; } ?>>Impact</option>
						<option value="Lucida"         <?php if($font_family == 'Lucida' ) { echo "selected"; } ?>>Lucida</option>
						<option value="Lucida Grande"         <?php if($font_family == 'Lucida Grande' ) { echo "selected"; } ?>>Lucida Grande</option>
						<option value="Open Sans"   <?php if($font_family == 'Open Sans' ) { echo "selected"; } ?>>Open Sans</option>
						<option value="OpenSansBold"   <?php if($font_family == 'OpenSansBold' ) { echo "selected"; } ?>>OpenSansBold</option>
						<option value="Palatino Linotype"       <?php if($font_family == 'Palatino Linotype' ) { echo "selected"; } ?>>Palatino</option>
						<option value="Sans"           <?php if($font_family == 'Sans' ) { echo "selected"; } ?>>Sans</option>
						<option value="sans-serif"           <?php if($font_family == 'sans-serif' ) { echo "selected"; } ?>>Sans-Serif</option>
						<option value="Tahoma"         <?php if($font_family == 'Tahoma' ) { echo "selected"; } ?>>Tahoma</option>
						<option value="Times New Roman"          <?php if($font_family == 'Times New Roman' ) { echo "selected"; } ?>>Times New Roman</option>
						<option value="Trebuchet"      <?php if($font_family == 'Trebuchet' ) { echo "selected"; } ?>>Trebuchet</option>
						<option value="Verdana"        <?php if($font_family == 'Verdana' ) { echo "selected"; } ?>>Verdana</option>
					</optgroup>
				</select>
				<!-- Tooltip -->
				<div id="font_family_tp" style="display:none;">
					<div style="color:#fff !important;padding:10px;max-width: 300px;">
						<h2 style="color:#fff !important;">You can update Title and Description Font Family/Style from here. Select any one form these options.</h2>
					
					</div>
		    	</div>
			</td>
		</tr>
		<tr>
			<th scope="row"><label><?php _e('Expand/Collapse Faq Option On Page Load',wpshopmart_faq_text_domain); ?></label>
			<a  class="ac_tooltip" href="#help" data-tooltip="#expand_option_tp"><i class="fa fa-lightbulb-o"></i></a>
				
			</th>
			<td>
				<span style="display:block;margin-bottom:10px"><input type="radio" name="expand_option" id="expand_option" value="1" <?php if($expand_option == '1' ) { echo "checked"; } ?> /> First FAQ Open </span>
				<span style="display:block;margin-bottom:10px"><input type="radio" name="expand_option" id="expand_option2" value="2" <?php if($expand_option == '2' ) { echo "checked"; } ?>  /> Open All FAQ </span>
				<span style="display:block"><input type="radio" name="expand_option" id="expand_option2" value="3"  <?php if($expand_option == '3' ) { echo "checked"; } ?> /> Hide/close All FAQ </span>
				<!-- Tooltip -->
				<div id="expand_option_tp" style="display:none;">
					<div style="color:#fff !important;padding:10px;">
						<h2 style="color:#fff !important;"><?php _e('Expand/Collapse Faq Option On Page Load',wpshopmart_faq_text_domain); ?></h2>
						<img src="<?php echo wpshopmart_faq_directory_url.'assets/tooltip/img/iocn-bg-color.png'; ?>">
						<br>
						<img src="<?php echo wpshopmart_faq_directory_url.'assets/tooltip/img/toggle.png'; ?>">
					
					</div>
		    	</div>
			</td>
		</tr>
		
		<tr>
			<th scope="row"><label><?php _e('Faq Styles',wpshopmart_faq_text_domain); ?></label>
			<a  class="ac_tooltip" href="#help" data-tooltip="#ac_styles_tp"><i class="fa fa-lightbulb-o"></i></a>
				
			</th>
			<td>
				<span style="display:block;margin-bottom:10px"><input type="radio" name="ac_styles" id="ac_styles" value="1" <?php if($ac_styles == '1' ) { echo "checked"; } ?> /> Simple </span>
				<span style="display:block;margin-bottom:10px"><input type="radio" name="ac_styles" id="ac_styles2" value="2" <?php if($ac_styles == '2' ) { echo "checked"; } ?>  /> Soft </span>
				<span style="display:block"><input type="radio" name="ac_styles" id="ac_styles3" value="3"  <?php if($ac_styles == '3' ) { echo "checked"; } ?> /> Noise </span>
				<!-- Tooltip -->
				<div id="ac_styles_tp" style="display:none;">
					<div style="color:#fff !important;padding:10px;">
						<h2 style="color:#fff !important;"><?php _e('Faq Styles',wpshopmart_faq_text_domain); ?></h2>
						<img src="<?php echo wpshopmart_faq_directory_url.'assets/tooltip/img/soft.png'; ?>">
						<br>
						<img src="<?php echo wpshopmart_faq_directory_url.'assets/tooltip/img/noise.png'; ?>">
					</div>
		    	</div>
			</td>
		</tr>
		
		<script>
		jQuery(function() {

		  
		  // Target a single one
		  jQuery("#custom_css").linedtextarea();

		});
		jQuery('.ac_tooltip').darkTooltip({
				opacity:1,
				gravity:'east',
				size:'small'
			});
		</script>
	</tbody>
</table>