<?php
if(isset($PostID) && isset($_POST['faq_save_data_action']) ) {
			$TotalCount = count($_POST['faq_title']);
			$ShortcodeArray = array();
			if($TotalCount) {
				for($i=0; $i < $TotalCount; $i++) {
					$faq_title           = stripslashes(sanitize_text_field($_POST['faq_title'][$i]));
					$faq_title_icon      = sanitize_text_field($_POST['faq_title_icon'][$i]);
					$enable_single_icon  = sanitize_text_field($_POST['enable_single_icon'][$i]);
					$faq_desc            = stripslashes($_POST['faq_desc'][$i]);

					$ShortcodeArray[] = array(
						'faq_title'          => $faq_title,
						'faq_title_icon'     => $faq_title_icon,
						'enable_single_icon' => $enable_single_icon,
						'faq_desc'           => $faq_desc,
						);
				}
				update_post_meta($PostID, 'wpsm_faq_data', serialize($ShortcodeArray));
				update_post_meta($PostID, 'wpsm_faq_count', $TotalCount);
			} else {
				$TotalCount = -1;
				update_post_meta($PostID, 'wpsm_faq_count', $TotalCount);
				$AccordionArray = array();
				update_post_meta($PostID, 'wpsm_faq_data', serialize($ShortcodeArray));
			}
		}
 ?>