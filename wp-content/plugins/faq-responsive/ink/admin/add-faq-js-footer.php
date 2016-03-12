<script>
	function add_new_accordion(){
	var output = '<li class="wpsm_ac-panel single_acc_box" >'+
		'<span class="ac_label"><?php _e("Faq Title",wpshopmart_faq_text_domain); ?></span>'+
		'<input type="text" id="faq_title[]" name="faq_title[]" value="" placeholder="Enter Faq Title Here" class="wpsm_ac_label_text">'+
		'<span class="ac_label"l><?php _e("Faq Description",wpshopmart_faq_text_domain); ?></span>'+
		'<textarea  id="faq_desc[]" name="faq_desc[]"  placeholder="Enter Faq Description Here" class="wpsm_ac_label_text"></textarea>'+
		'<span class="ac_label"><?php _e("Faq Icon",wpshopmart_faq_text_domain); ?></span>'+
		'<div class="form-group input-group" >'+
		'	<input data-placement="bottomRight" id="faq_title_icon[]" name="faq_title_icon[]" class="form-control icp icp-auto" value="fa-laptop" type="text" readonly="readonly" />'+
			'<span class="input-group-addon "></span>'+
		'</div>'+
		'<span class="ac_label"><?php _e('Display Above Icon',wpshopmart_faq_text_domain); ?></span>'+
		'<select name="enable_single_icon[]" style="width:100%" >'+
				'<option value="yes" selected=selected>Yes</option>'+
				'<option value="no" >No</option>'+
		'</select>'+
		'<a class="remove_button" href="#delete" id="remove_bt"><i class="fa fa-trash-o"></i></a>'+
		'</li>';
	jQuery(output).hide().appendTo("#accordion_panel").slideDown("slow");
	call_icon();
	}
	jQuery(document).ready(function(){

	  jQuery('#accordion_panel').sortable({
	  
	   revert: true,
	 
	  });
	});
	
	
</script>
<script>
	jQuery(function(jQuery)
		{
			var accordion = 
			{
				accordion_ul: '',
				init: function() 
				{
					this.accordion_ul = jQuery('#accordion_panel');

					this.accordion_ul.on('click', '.remove_button', function() {
					if (confirm('Are you sure you want to delete this?')) {
						jQuery(this).parent().slideUp(600, function() {
							jQuery(this).remove();
						});
					}
					return false;
					});
					 jQuery('#delete_all_acc').on('click', function() {
						if (confirm('Are you sure you want to delete all the Faq?')) {
							jQuery(".single_acc_box").slideUp(600, function() {
								jQuery(".single_acc_box").remove();
							});
							jQuery('html, body').animate({ scrollTop: 0 }, 'fast');
							
						}
						return false;
					});
					
			   }
			};
		accordion.init();
	});
</script>