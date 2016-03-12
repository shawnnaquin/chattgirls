<?php
$labels = array(
				'name'                => _x( 'Faq Responsive', 'Faq Responsive', wpshopmart_faq_text_domain ),
				'singular_name'       => _x( 'Faq Responsive', 'Faq Responsive', wpshopmart_faq_text_domain ),
				'menu_name'           => __( 'Faq Responsive', wpshopmart_faq_text_domain ),
				'parent_item_colon'   => __( 'Parent Item:', wpshopmart_faq_text_domain ),
				'all_items'           => __( 'All Faq', wpshopmart_faq_text_domain ),
				'view_item'           => __( 'View Faq', wpshopmart_faq_text_domain ),
				'add_new_item'        => __( 'Add New Faq', wpshopmart_faq_text_domain ),
				'add_new'             => __( 'Add New Faq', wpshopmart_faq_text_domain ),
				'edit_item'           => __( 'Edit Faq', wpshopmart_faq_text_domain ),
				'update_item'         => __( 'Update Faq', wpshopmart_faq_text_domain ),
				'search_items'        => __( 'Search Faq', wpshopmart_faq_text_domain ),
				'not_found'           => __( 'No Faq Found', wpshopmart_faq_text_domain ),
				'not_found_in_trash'  => __( 'No Faq found in Trash', wpshopmart_faq_text_domain ),
			);
			$args = array(
				'label'               => __( 'Faq Panels', wpshopmart_faq_text_domain ),
				'description'         => __( 'Faq Panels', wpshopmart_faq_text_domain ),
				'labels'              => $labels,
				'supports'            => array( 'title', '', '', '', '', '', '', '', '', '', '', ),
				//'taxonomies'          => array( 'category', 'post_tag' ),
				 'hierarchical'        => false,
				'public'              => false,
				'show_ui'             => true,
				'show_in_menu'        => true,
				'show_in_nav_menus'   => false,
				'show_in_admin_bar'   => false,
				'menu_position'       => 5,
				'menu_icon'           => 'dashicons-exerpt-view',
				'can_export'          => true,
				'has_archive'         => true,
				'exclude_from_search' => false,
				'publicly_queryable'  => false,
				'capability_type'     => 'page',
			);
			register_post_type( 'wpsm_faq_r', $args );
			
 ?>