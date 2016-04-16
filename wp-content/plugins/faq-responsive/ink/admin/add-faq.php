<div style=" overflow: hidden;padding: 10px;">
<style>
	.html_editor_button{
		border-radius:0px;
		background-color: #9C9C9C;
		border-color: #9C9C9C;
		margin-bottom:20px;
	}
	</style>
	<h3><?php _e('Add Faq',wpshopmart_faq_text_domain); ?></h3>
	<input type="hidden" name="faq_save_data_action" value="faq_save_data_action" />
	<ul class="clearfix" id="accordion_panel">
	<?php
			$i=1;
			$data = unserialize(get_post_meta( $post->ID, 'wpsm_faq_data', true));
			$TotalCount =  get_post_meta( $post->ID, 'wpsm_faq_count', true );
			if($TotalCount) 
			{
				if($TotalCount!=-1)
				{
					foreach($data as $single_data)
					{
						 $faq_title = $single_data['faq_title'];
						 $faq_title_icon = $single_data['faq_title_icon'];
						 $enable_single_icon = $single_data['enable_single_icon'];
						 $faq_desc = $single_data['faq_desc'];
						?>
						<li class="wpsm_ac-panel single_acc_box" >
							<span class="ac_label"><?php _e('Faq Title',wpshopmart_faq_text_domain); ?></span>
							<input type="text" id="faq_title[]" name="faq_title[]" value="<?php echo  $faq_title; ?>" placeholder="Enter Faq Title Here" class="wpsm_ac_label_text">
							<span class="ac_label"><?php _e('Faq Description',wpshopmart_faq_text_domain); ?></span>
							<textarea  id="faq_desc[]" name="faq_desc[]"  placeholder="Enter Faq Description Here" class="wpsm_ac_label_text"><?php echo $faq_desc; ?></textarea>
							<button type="button" class="btn btn-primary btn-block html_editor_button" data-toggle="modal" data-target=".bs-example-modal-lg" id="<?php echo $i; ?>"  onclick="open_editor(<?php echo $i; ?>)">Use WYSIWYG Editor </button>
							
							<span class="ac_label"><?php _e('Faq Icon',wpshopmart_faq_text_domain); ?></span>
							<div class="form-group input-group">
								<input data-placement="bottomRight" id="faq_title_icon[]" name="faq_title_icon[]" class="form-control icp icp-auto" value="<?php echo  $faq_title_icon; ?>" type="text" readonly="readonly" />
								<span class="input-group-addon "></span>
							</div>
							<span class="ac_label"><?php _e('Display Above Icon',wpshopmart_faq_text_domain); ?></span>
							<select name="enable_single_icon[]" style="width:100%" >
								<option value="yes" <?php if($enable_single_icon == 'yes') echo "selected=selected"; ?>>Yes</option>
								<option value="no" <?php if($enable_single_icon == 'no') echo "selected=selected"; ?>>No</option>
								
							</select>
							
							<a class="remove_button" href="#delete" id="remove_bt" ><i class="fa fa-trash-o"></i></a>
							
						</li>
						<?php 
						$i++;
					} // end of foreach
				}else{
				echo "<h2>No Faq Found</h2>";
				}
			}
			else 
			{
				  for($i=1; $i<=2; $i++)
				  {
					  ?>
					 <li class="wpsm_ac-panel single_acc_box" >
							<span class="ac_label"><?php _e('Faq Title',wpshopmart_faq_text_domain); ?></span>
							<input type="text" id="faq_title[]" name="faq_title[]" value="Sample Title" placeholder="Enter Faq Title Here" class="wpsm_ac_label_text">
							<span class="ac_label"><?php _e('Faq Description',wpshopmart_faq_text_domain); ?></span>
							<textarea  id="faq_desc[]" name="faq_desc[]"  placeholder="Enter Faq Description Here" class="wpsm_ac_label_text">Sample Description</textarea>
							<button type="button" class="btn btn-primary btn-block html_editor_button" data-toggle="modal" data-target=".bs-example-modal-lg" id="<?php echo $i; ?>"  onclick="open_editor(<?php echo $i; ?>)">Use WYSIWYG Editor </button>
						
							<span class="ac_label"><?php _e('Faq Icon',wpshopmart_faq_text_domain); ?></span>
							<div class="form-group input-group">
								<input data-placement="bottomRight" id="faq_title_icon[]" name="faq_title_icon[]" class="form-control icp icp-auto" value="fa-laptop" type="text" readonly="readonly" />
								<span class="input-group-addon "></span>
							</div>
							<span class="ac_label"><?php _e('Display Above Icon',wpshopmart_faq_text_domain); ?></span>
							<select name="enable_single_icon[]" style="width:100%" >
								<option value="yes" selected>Yes</option>
								<option value="no" >No</option>
								
							</select>
							
							<a class="remove_button" href="#delete" id="remove_bt" ><i class="fa fa-trash-o"></i></a>
							
						</li>
					 <?php
				}
			}
			?>
	</ul>
</div>


<!-- Modal -->
	<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"  data-backdrop="static" data-keyboard="false">
	  <div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">Html Editor Area</h4>
		  </div>
		  <div class="modal-body">
				<style>
				.switch-tmce {
					display: none;
				}
				</style>
				<?php

				$content = '';
				$editor_id = 'get_text';

				wp_editor( $content, $editor_id );

				?>
				<input type="hidden" value="" id="get_id" />
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-primary" data-dismiss="modal" onclick="insert_html()">Insert Code In Description</button>
		  </div>
		</div>
	  </div>
	</div>



<a class="wpsm_ac-panel add_wpsm_ac_new" id="add_new_ac" onclick="add_new_accordion()"   >
	<?php _e('Add New Faq', wpshopmart_faq_text_domain); ?>
</a>
<a  style="float: left;padding:10px !important;background:#31a3dd;" class=" add_wpsm_ac_new delete_all_acc" id="delete_all_acc"    >
	<i style="font-size:57px;"class="fa fa-trash-o"></i>
	<span style="display:block"><?php _e('Delete All',wpshopmart_faq_text_domain); ?></span>
</a>
<div style="clear:left;"></div>
<?php require('add-faq-js-footer.php'); ?>