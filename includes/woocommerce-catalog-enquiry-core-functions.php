<?php

if (!function_exists('woocommerce_catalog_enquiry_alert_notice')) {
	 function woocommerce_catalog_enquiry_alert_notice() {
		?>
		<div id="message" class="error">
			<p><?php printf( __( '%sWoocommerce Catalog Enquiry is inactive.%s The %sWooCommerce plugin%s must be active for the Woocommerce Catalog Enquiry to work. Please %sinstall & activate WooCommerce%s', WOOCOMMERCE_CATALOG_ENQUIRY_TEXT_DOMAIN ), '<strong>', '</strong>', '<a target="_blank" href="http://wordpress.org/extend/plugins/woocommerce/">', '</a>', '<a href="' . admin_url( 'plugins.php' ) . '">', '&nbsp;&raquo;</a>' ); ?></p>
		</div>
		<?php
	}
}


if (!function_exists('woocommerce_catalog_enquiry_validate_color_hex_code')) {
		function woocommerce_catalog_enquiry_validate_color_hex_code($code) {
				$color = str_replace( '#', '', $code );
				return '#'.$color;
		}
}

// Old version to new migration
if (!function_exists('woocommerce_catalog_enquiry_option_migration_3_to_4')) {

	function woocommerce_catalog_enquiry_option_migration_3_to_4() {
		global $Woocommerce_Catalog_Enquiry;
		
		if ( !get_option( 'woocommerce_catalog_migration_completed' ) ) :

		// Old catalog button data
		$woocommerce_catalog_old_button = get_option( 'dc_wc_Woocommerce_Catalog_Enquiry_button_settings_name', true );
		
		// Old catalog general data
		$woocommerce_catalog_old_options = get_option('dc_wc_Woocommerce_Catalog_Enquiry_general_settings_name', true );

		// Old catalog exclusion data
		$woocommerce_catalog_old_exclusion = get_option('dc_wc_Woocommerce_Catalog_Enquiry_exclusion_settings_name', true ); 
		if ( !empty( $woocommerce_catalog_old_exclusion ) ) {

			$update_new_exclution = array();
			foreach ($woocommerce_catalog_old_exclusion as $key => $value) {
				if ( $key == 'myuserroles_list' ) {
					$update_new_exclution['woocommerce_userroles_list'] = $value;
				}
				if ( $key == 'myuser_list' ) {
					$update_new_exclution['woocommerce_user_list'] = $value;
				}
				if ( $key == 'myproduct_list' ) {
					$update_new_exclution['woocommerce_product_list'] = $value;
				}
				if ( $key == 'mycategory_list' ) {
					$update_new_exclution['woocommerce_category_list'] = $value;
				}
			}
			update_option( 'woocommerce_catalog_enquiry_exclusion_settings', $update_new_exclution );
		}

		// New catalog button data
		if ( !empty( $woocommerce_catalog_old_button ) ) {
			update_option( 'woocommerce_catalog_enquiry_button_appearence_settings', $woocommerce_catalog_old_button );
		}

		if ( !empty( $woocommerce_catalog_old_options ) ) {
			
			// Old catalog general data
			update_option( 'woocommerce_catalog_enquiry_general_settings', $woocommerce_catalog_old_options );

			// name
			if ( isset( $woocommerce_catalog_old_options['name_label'] ) && $woocommerce_catalog_old_options['name_label'] != ''  ){

				$woocommerce_catalog_old_options['form_name'] = array( 'label' => $woocommerce_catalog_old_options['form_name'] );
			}
			// Email
			if ( isset( $woocommerce_catalog_old_options['email_label'] ) && $woocommerce_catalog_old_options['email_label'] != ''  ){

				$woocommerce_catalog_old_options['form_email'] = array( 'label' => $woocommerce_catalog_old_options['form_email'] );
			}
			// File upload limit
			if ( isset( $woocommerce_catalog_old_options['filesize_limit'] ) && $woocommerce_catalog_old_options['filesize_limit'] != ''  ){

				$woocommerce_catalog_old_options['filesize_limit'] = array( 'label' => $woocommerce_catalog_old_options['filesize_limit'] );
			}

			// Subject
			if ( isset($woocommerce_catalog_old_options['is_subject']) &&  $woocommerce_catalog_old_options['is_subject'] == 'Enable' && isset( $woocommerce_catalog_old_options['subject_label'] ) && $woocommerce_catalog_old_options['subject_label'] != ''  ){

				$woocommerce_catalog_old_options['form_subject'] = array( 'label' => $woocommerce_catalog_old_options['subject_label'], 'is_enable' => 'Enable' );
			}

			// phone
			if ( isset($woocommerce_catalog_old_options['is_phone']) &&  $woocommerce_catalog_old_options['is_phone'] == 'Enable' && isset( $woocommerce_catalog_old_options['phone_label'] ) && $woocommerce_catalog_old_options['phone_label'] != ''  ){

				$woocommerce_catalog_old_options['form_phone'] = array( 'label' => $woocommerce_catalog_old_options['phone_label'], 'is_enable' => 'Enable' );
			}

			// Address
			if ( isset($woocommerce_catalog_old_options['is_address']) &&  $woocommerce_catalog_old_options['is_address'] == 'Enable' && isset( $woocommerce_catalog_old_options['address_label'] ) && $woocommerce_catalog_old_options['address_label'] != ''  ){
				$woocommerce_catalog_old_options['form_address'] = array( 'label' => $woocommerce_catalog_old_options['address_label'], 'is_enable' => 'Enable' );
			}

			// comment
			if ( isset($woocommerce_catalog_old_options['is_comment']) &&  $woocommerce_catalog_old_options['is_comment'] == 'Enable' && isset( $woocommerce_catalog_old_options['comment_label'] ) && $woocommerce_catalog_old_options['comment_label'] != ''  ){
				$woocommerce_catalog_old_options['form_comment'] = array( 'label' => $woocommerce_catalog_old_options['comment_label'], 'is_enable' => 'Enable' );
			}

			// file upload
			if ( isset($woocommerce_catalog_old_options['is_fileupload']) &&  $woocommerce_catalog_old_options['is_fileupload'] == 'Enable' && isset( $woocommerce_catalog_old_options['fileupload_label'] ) && $woocommerce_catalog_old_options['fileupload_label'] != ''  ){
				$woocommerce_catalog_old_options['form_fileupload'] = array( 'label' => $woocommerce_catalog_old_options['fileupload_label'], 'is_enable' => 'Enable' );
			}

			// Capta label
			if ( isset($woocommerce_catalog_old_options['is_captcha']) &&  $woocommerce_catalog_old_options['is_captcha'] == 'Enable' && isset( $woocommerce_catalog_old_options['captcha_label'] ) && $woocommerce_catalog_old_options['captcha_label'] != ''  ){
				$woocommerce_catalog_old_options['form_captcha'] = array( 'label' => $woocommerce_catalog_old_options['captcha_label'], 'is_enable' => 'Enable' );
			}

			update_option( 'woocommerce_catalog_enquiry_from_settings', $woocommerce_catalog_old_options );

		}

		// By default set
		$general_settings = get_option( 'woocommerce_catalog_enquiry_general_settings' );
		if ( is_array( $general_settings ) && !empty( $general_settings ) ){
			$general_settings['for-user-type'] = 2;
			update_option( 'woocommerce_catalog_enquiry_general_settings', $general_settings );
		} else {
			$general_settings = array();
			$general_settings['for-user-type'] = 2;
			update_option( 'woocommerce_catalog_enquiry_general_settings', $general_settings );
		}

		// set button type
		$button_settings = get_option( 'woocommerce_catalog_enquiry_button_appearence_settings' );
		if ( is_array( $button_settings ) &&  !empty( $button_settings ) ){
			$button_settings['button_type'] = 1;
			update_option( 'woocommerce_catalog_enquiry_button_appearence_settings', $button_settings );
		} else {
			$button_settings = array();
			$button_settings['button_type'] = 1;
			update_option( 'woocommerce_catalog_enquiry_button_appearence_settings', $button_settings );
		}

		delete_option( 'dc_wc_Woocommerce_Catalog_Enquiry_general_settings_name' );
		delete_option( 'dc_wc_Woocommerce_Catalog_Enquiry_button_settings_name' );
		delete_option( 'dc_wc_Woocommerce_Catalog_Enquiry_exclusion_settings_name' );

		update_option( 'woocommerce_catalog_migration_completed', 'migrated' );
		endif;
	}
}

// find all wp users
if (!function_exists('woocommerce_catalog_wp_users')) {
	
	function woocommerce_catalog_wp_users(){
		$users = get_users();
		$all_users = array();
		foreach($users as $user) {                  
			$all_users[$user->data->ID] = $user->data->display_name;
		}
		return $all_users;
	}
}

// find all woocommerce product
if (!function_exists('woocommerce_catalog_products')) {
	
	function woocommerce_catalog_products() {
		$args = apply_filters('woocommerce_catalog_limit_backend_product', array( 'posts_per_page' => -1, 'post_type' => 'product', 'post_status' => 'publish', 'orderby' => 'title', 'order' => 'ASC' ));
		$woocommerce_product = get_posts( $args );
		$all_products = array();
		foreach ( $woocommerce_product as $post => $value ){
			$all_products[$value->ID] = $value->post_title;     
		}
		return $all_products;
	}
}
// find all product caegory
if (!function_exists('woocommerce_catalog_product_category')) {
	function woocommerce_catalog_product_category() { 
		$all_product_cat = array();
		$args = array( 'orderby' => 'name', 'order' => 'ASC' );
		$terms = get_terms( 'product_cat', $args );
		foreach ( $terms as $term) {
			$all_product_cat[$term->term_id] = $term->name;
		}
		return $all_product_cat;
	}
}

// Get all woocommerce pages
if (!function_exists('woocommerce_catalog_wp_pages')) {
	
	function woocommerce_catalog_wp_pages() {
		$args = array( 'posts_per_page' => -1, 'post_type' => 'page', 'orderby' => 'title', 'order' => 'ASC' );
				$wp_posts = get_posts( $args );
				foreach ( $wp_posts as $post ) : setup_postdata( $post );    
				$page_array[$post->ID] = $post->post_title;       
				endforeach; 
				wp_reset_postdata();
		return $page_array;
	}
}

if (!function_exists('mvx_catalog_admin_tabs')) {
	function mvx_catalog_admin_tabs() {
		$pages_array = $role_array = $all_users = $all_products = $all_product_cat = [];
		$pages = get_pages();
		if($pages){
			foreach ($pages as $page) {
				$pages_array[] = array(
					'value'=> $page->ID,
					'label'=> $page->post_title,
					'key'=> $page->ID,
				);
			}
		}

		if (wp_roles()->roles) {
			foreach (wp_roles()->roles as $key => $element) {
				$role_array[] = array(
					'value'=> $key,
					'label'=> $element['name'],
					'key'=> $key,
				);
			}
		}

		$users = get_users();
		foreach($users as $user) {
			$all_users[] = array(
				'value'=> $user->data->ID,
				'label'=> $user->data->display_name,
				'key'=> $user->data->ID,
			);
		}

		$args = apply_filters('woocommerce_catalog_limit_backend_product', array( 'posts_per_page' => -1, 'post_type' => 'product', 'post_status' => 'publish', 'orderby' => 'title', 'order' => 'ASC' ));
		$woocommerce_product = get_posts( $args );
		foreach ( $woocommerce_product as $post => $value ) {
			$all_products[] = array(
				'value'=> $value->ID,
				'label'=> $value->post_title,
				'key'=> $value->ID,
			);   
		}

		$args_cat = array( 'orderby' => 'name', 'order' => 'ASC' );
		$terms = get_terms( 'product_cat', $args_cat );
		foreach ( $terms as $term) {
			$all_product_cat[] = array(
				'value'=> $term->term_id,
				'label'=> $term->name,
				'key'=> $term->term_id,
			); 
		}

		$catalog_settings_page_endpoint = array(
			'general' => array(
				'tablabel'        =>  __('General', 'multivendorx'),
				'apiurl'          =>  'save_enquiry',
				'description'     =>  __('General', 'multivendorx'),
				'icon'            =>  'icon-general-tab',
				'submenu'         =>  'settings',
				'modulename'      =>  [
					[
	                    'key'       =>  'woocommerce_catalog_enquiry_general_settings',
	                    'type'      =>  'blocktext',
	                    'label'     =>  __( 'no_label', 'multivendorx' ),
	                    'blocktext'      =>  __( "Common Settings", 'multivendorx' ),
	                    'database_value' => '',
	                ],
					[
						'key'    => 'is_enable',
						'label'   => __( "Catalog Mode", 'multivendorx' ),
						'class'     => 'mvx-toggle-checkbox',
						'type'    => 'checkbox',
						'options' => array(
								array(
										'key'=> "is_enable",
										'label'=> apply_filters( 'woocommerce_catalog_enquiry_enable_catalog_text', __('Enable this to activate catalog mode sitewide. This will remove your Add to Cart button. To keep Add to Cart button in your site, upgrade to  <a href="https://multivendorx.com/product/woocommerce-catalog-enquiry-pro/" target="_blank">WooCommerce Catalog Enquiry Pro</a>.', 'woocommerce-catalog-enquiry', 'woocommerce-catalog-enquiry') ),
										'value'=> "is_enable"
								),
						),
						'database_value' => array(),
					],
					[
						'key'    => 'is_enable_enquiry',
						'label'   => __( "Product Enquiry Button", 'multivendorx' ),
						'class'     => 'mvx-toggle-checkbox',
						'type'    => 'checkbox',
						'options' => array(
								array(
										'key'=> "is_enable_enquiry",
										'label'=> __("Enable this to add the Enquiry button for all products. Use Exclusion settings to exclude specific product or category from enquiry.", 'multivendorx'),
										'value'=> "is_enable_enquiry"
								),
						),
						'database_value' => array(),
					],
					[
						'key'    => 'is_enable_out_of_stock',
						'label'   => __( "Product Enquiry Button When Product is Out Of Stock", 'multivendorx' ),
						'class'     => 'mvx-toggle-checkbox',
						'type'    => 'checkbox',
						'options' => array(
								array(
										'key'=> "is_enable_out_of_stock",
										'label'=> __("Enable this to add the Enquiry button for the products which is out of stock. Use Exclusion settings to exclude specific product or category from enquiry.", 'multivendorx'),
										'value'=> "is_enable_out_of_stock"
								),
						),
						'database_value' => array(),
					],
					[
						'key'       => 'for_user_type',
						'type'      => 'select',
						'label'     => __( 'Catalog Mode Applicable For', 'multivendorx' ),
						'desc'      => __( 'Select the type users where this catalog is applicable', 'multivendorx' ),
						'options' => array(
								array(
										'key' => "1",
										'label'=> __('Only Logged out Users', 'multivendorx'),
										'value'=> "1",
								),
								array(
										'key'=> "2",
										'label'=> __('Only Logged in Users', 'multivendorx'),
										'value'=> "2",
								),
								array(
										'key'=> "3",
										'label'=> __('All Users', 'multivendorx'),
										'value'=> '3',
								)
						),
						'database_value' => '',
					],
					[
						'key'    => 'is_hide_cart_checkout',
						'label'   => __( "Disable Cart and Checkout Page?", 'multivendorx' ),
						'class'     => 'mvx-toggle-checkbox',
						'type'    => 'checkbox',
						'options' => array(
								array(
										'key'=> "is_hide_cart_checkout",
										'label'=> apply_filters( 'woocommerce_catalog_enquiry_hide_cart', __('Enable this to redirect user to home page, if they click on the cart or checkout page. To set the redirection to another page kindly upgrade to <a href="https://multivendorx.com/product/woocommerce-catalog-enquiry-pro/" target="_blank">WooCommerce Catalog Enquiry Pro</a>.', 'woocommerce-catalog-enquiry') ),
										'value'=> "is_hide_cart_checkout"
								),
						),
						'database_value' => array(),
					],
					[
						'key'       => 'disable_cart_page_link',
						'type'      => 'select',
						'label'     => __( 'Set Redirect Page', 'multivendorx' ),
						'desc'      => __( 'Select page where user will be redirected for disable cart page.', 'multivendorx' ),
						'options' => $pages_array,
						'database_value' => '',
					],
					[
						'key'    => 'is_page_redirect',
						'label'   => __( "Redirect after Enquiry form Submission", 'multivendorx' ),
						'class'     => 'mvx-toggle-checkbox',
						'type'    => 'checkbox',
						'options' => array(
								array(
										'key'=> "is_page_redirect",
										'label'=> __("Enable this to redirect user to another page after successful enquiry submission.", 'multivendorx'),
										'value'=> "is_page_redirect"
								),
						),
						'database_value' => array(),
					],
					[
						'key'       => 'redirect_page_id',
						'type'      => 'select',
						'label'     => __( 'Set Redirect Page', 'multivendorx' ),
						'desc'      => __( 'Select page where user will be redirected after successful enquiry.', 'multivendorx' ),
						'options' => $pages_array,
						'database_value' => '',
					],

					[
	                    'key'       => 'separator1_content',
	                    'type'      => 'section',
	                    'label'     => "",
                	],
                	[
	                    'key'       =>  'woocommerce_catalog_enquiry_display_settings',
	                    'type'      =>  'blocktext',
	                    'label'     =>  __( 'no_label', 'multivendorx' ),
	                    'blocktext'      =>  __( "Display Options", 'multivendorx' ),
	                    'database_value' => '',
	                ],
					[
						'key'    => 'is_remove_price_free',
						'label'   => __( "Remove Product Price?", 'multivendorx' ),
						'class'     => 'mvx-toggle-checkbox',
						'type'    => 'checkbox',
						'options' => array(
								array(
										'key'=> "is_remove_price_free",
										'label'=> __("Enable this option to remove the product price display from site.", 'multivendorx'),
										'value'=> "is_remove_price_free"
								),
						),
						'database_value' => array(),
					],
					[
						'key'    => 'is_disable_popup',
						'label'   => __( "Disable Enquiry form via popup?", 'multivendorx' ),
						'class'     => 'mvx-toggle-checkbox',
						'type'    => 'checkbox',
						'options' => array(
								array(
										'key'=> "is_disable_popup",
										'label'=> __("By default the form will be displayed via popup. Enable this, if you want to display the form below the product description.", 'multivendorx'),
										'value'=> "is_disable_popup"
								),
						),
						'database_value' => array(),
					],


					[
	                    'key'       => 'separator2_content',
	                    'type'      => 'section',
	                    'label'     => "",
	                ],
	                [
	                    'key'       =>  'woocommerce_catalog_enquiry_email_settings',
	                    'type'      =>  'blocktext',
	                    'label'     =>  __( 'no_label', 'multivendorx' ),
	                    'blocktext'      =>  __( "Enquiry Email Receivers Settings", 'multivendorx' ),
	                    'database_value' => '',
	                ],
					[
		                'key'       => 'other_emails',
		                'type'      => 'text',
		                'label'     => __( 'Additional Recivers Emails', 'multivendorx' ),
		                'desc'      => __('Enter email address if you want to receive enquiry mail along with admin mail. You can add multiple commma seperated emails. Default: Admin emails.','multivendorx'),
		                'database_value' => '',
		            ],
					[
						'key'    => 'is_other_admin_mail',
						'label'   => __( "Remove admin email", 'multivendorx' ),
						'class'     => 'mvx-toggle-checkbox',
						'type'    => 'checkbox',
						'options' => array(
								array(
										'key'=> "is_other_admin_mail",
										'label'=> __("Enable this if you want remove admin email from reciever list.", 'multivendorx'),
										'value'=> "is_other_admin_mail"
								),
						),
						'database_value' => array(),
					],
					
				]
			),
			'button-appearance'   => array(
				'tablabel'      =>  __('Button Appearance', 'multivendorx'),
				'apiurl'        =>  'save_enquiry',
				'description'   =>  __("Manage the appearance of your seller's dashboard.", 'multivendorx'),
				'icon'          =>  'icon-button-appearance-tab',
				'submenu'       =>  'settings',
				'modulename'    =>  [
					[
	                    'key'       =>  'woocommerce_catalog_enquiry_email_settings',
	                    'type'      =>  'blocktext',
	                    'label'     =>  __( 'no_label', 'multivendorx' ),
	                    'blocktext'      =>  __( "Enquiry Email Receivers Settings", 'multivendorx' ),
	                    'database_value' => '',
	                ],
					[
		                'key'       => 'enquiry_button_text',
		                'type'      => 'text',
		                'label'     => __( 'Button Text', 'multivendorx' ),
		                'desc'      => __('Enter the text for your Enquery Button.','multivendorx'),
		                'database_value' => '',
		            ],
      				[
						'key'       => 'for_user_type',
						'type'      => 'select',
						'label'     => __( 'Catalog Mode Applicable For', 'multivendorx' ),
						'desc'      => __( 'Select the type users where this catalog is applicable', 'multivendorx' ),
						'options' => array(
								array(
										'key' => "1",
										'label'=> __('Read More', 'multivendorx'),
										'value'=> "1",
								),
								array(
										'key'=> "2",
										'label'=> __('Custom Link For All Products', 'multivendorx'),
										'value'=> "2",
								),
								array(
										'key'=> "3",
										'label'=> __('Individual link in all products', 'multivendorx'),
										'value'=> '3',
								),
								array(
										'key'=> "4",
										'label'=> __('No Link Just #', 'multivendorx'),
										'value'=> '4',
								)
						),
						'database_value' => '',
					],
					[
		                'key'       => 'custom_css_product_page',
		                'type'      => 'textarea',
		                'class'     =>  'mvx-setting-wpeditor-class',
		                'desc'      => __('Put your custom css here, to customize the enquiry form.', 'multivendorx'),
		                'label'     => __( 'Custom CSS', 'multivendorx' ),
		                'database_value' => '',
		            ],
		            [
		                'key'       => 'custom_own_button_style',
		                'type'      => 'own_button',
		                'class'     =>  'mvx-setting-own-class',
		                'desc'      => __('', 'multivendorx'),
		                'label'     => __( 'Make your own Button Style', 'multivendorx' ),
		                'database_value' => '',
		            ],
				]
			),
			'exclusion'       =>  array(
				'tablabel'      =>  __('Exclusion', 'multivendorx'),
				'apiurl'        =>  'save_enquiry',
				'description'   =>  __("Manage setting related to the sellers shop.", 'multivendorx'),
				'icon'          =>  'icon-exclusion-tab',
				'submenu'       =>  'settings',
				'modulename'    =>  [
					[
		                'key'       => 'woocommerce_userroles_list',
		                'type'      => 'multi-select',
		                'label'     => __( 'User Role Specific Exclusion', 'multivendorx' ),
		                'desc'        => __( 'Select the user roles, who won’t be able to send enquiry.', 'multivendorx' ),
		                'options' => $role_array,
		                'database_value' => '',
	            	],
	            	[
		                'key'       => 'woocommerce_user_list',
		                'type'      => 'multi-select',
		                'label'     => __( 'User Name Specific Exclusion', 'multivendorx' ),
		                'desc'        => __( 'Select the users, who won’t be able to send enquiry.', 'multivendorx' ),
		                'options' => $all_users,
		                'database_value' => '',
	            	],
	            	[
		                'key'       => 'woocommerce_product_list',
		                'type'      => 'multi-select',
		                'label'     => __( 'Product Specific Exclusion', 'multivendorx' ),
		                'desc'        => __( 'Select the products that should have the Add to cart button, instead of enquiry button.', 'multivendorx' ),
		                'options' => $all_products,
		                'database_value' => '',
	            	],
	            	[
		                'key'       => 'woocommerce_category_list',
		                'type'      => 'multi-select',
		                'label'     => __( 'Category Specific Exclusion', 'multivendorx' ),
		                'desc'        => __( 'Select the Category, where should have the Add to cart button, instead of enquiry button.', 'multivendorx' ),
		                'options' => $all_product_cat,
		                'database_value' => '',
	            	]
				]
			),
			'enquiry-form'  =>  array(
				'tablabel'      =>  __('Enquiry Form', 'multivendorx'),
				'apiurl'        =>  'save_enquiry',
				'description'   =>  __("Select the type of product that best suits your marketplace.", 'multivendorx'),
				'icon'          =>  'icon-enquiry-form-tab',
				'submenu'       =>  'settings',
				'modulename'    =>  [
					[
		                'key'       => 'top_content_form',
		                'type'      => 'textarea',
		                'desc'      => __('This content will be displayed above your from.', 'multivendorx'),
		                'label'     => __( 'Content Before Enquiry From', 'multivendorx' ),
		                'database_value' => '',
		             ],
		             [
		                'key'       => 'bottom_content_form',
		                'type'      => 'textarea',
		                'desc'      => __('This content will be displayed after your from.', 'multivendorx'),
		                'label'     => __( 'Content After Enquiry From', 'multivendorx' ),
		                'database_value' => '',
		            ],
		            [
						'key'    => 'is_override_form_heading',
						'label'   => __( "Override Form Title?", 'multivendorx' ),
						'class'     => 'mvx-toggle-checkbox',
						'type'    => 'checkbox',
						'options' => array(
								array(
										'key'=> "is_override_form_heading",
										'label'=> __('By default it will be "Enquiry about PRODUCT_NAME". Enable this to set your custom title.', 'woocommerce-catalog-enquiry'),
										'value'=> "is_override_form_heading"
								),
						),
						'database_value' => array(),
					],
					[
		                'key'       => 'custom_static_heading',
		                'depend_checkbox'    => 'is_override_form_heading',
		                'type'      => 'text',
		                'desc'      => __('Set custom from title. Use this specifier to replace the product name - %% PRODUCT_NAME %%.', 'multivendorx'),
		                'label'     => __( 'Set Form Title', 'multivendorx' ),
		                'database_value' => '',
		            ],
		            [
	                    'key'       => 'enquiry_form_fileds',
	                    'type'      => 'table',
	                    'label'     => __( 'Enquiry Form Fileds', 'multivendorx' ),
	                    'label_options' =>  array(
	                       __('Field Name', 'multivendorx'),
	                       __('Enable / Disable', 'multivendorx'),
	                       __('Set New Field Name', 'multivendorx'),
	                    ),
	                    'options' => [
	                        [
	                            'variable'=> __("Name", 'multivendorx'),
	                            'id' => 'name-label',
	                            'is_enable'=> false,
	                            'description'=> __('Enables you to create a seller dashboard ', 'multivendorx'),
	                        ],
	                        [
	                            'variable'=> __("Email", 'multivendorx'),
	                            'id' => 'email-label', 
	                            'is_enable'=> false,
	                            'description'=> __('Creates a page where the vendor registration form is available', 'multivendorx'),
	                        ],
	                        [
	                            'variable'=> __("Phone", 'multivendorx'),
	                            'id' => 'is-phone', 
	                            'is_enable'=> true,
	                            'description'=> __('Lets you view  a brief summary of the coupons created by the seller and number of times it has been used by the customers', 'multivendorx'),
	                        ],
	                        [
	                            'variable'=> __("Address", 'multivendorx'),
	                            'id' => 'is-address', 
	                            'is_enable'=> true,
	                            'description'=> __('Allows you to glance at the recent products added by seller', 'multivendorx'),
	                        ],
	                        [
	                            'variable'=> __("Enquiry About", 'multivendorx'),
	                            'id' => 'is-subject', 
	                            'is_enable'=> true,
	                            'description'=> __('Displays the products added by seller', 'multivendorx'),
	                        ],
	                        [
	                            'variable'=> __("Enquiry Details", 'multivendorx'),
	                            'id' => 'is-comment', 
	                            'is_enable'=> true,
	                            'description'=> __('Exhibits featured products added by the seller', 'multivendorx'),
	                        ],
	                        [
	                            'variable'=> __("File Upload", 'multivendorx'),
	                            'id' => 'is-fileupload', 
	                            'is_enable'=> true,
	                            'description'=> __('Allows you to see the products put on sale by a seller', 'multivendorx'),
	                        ],
	                        [
	                            'variable'=> __("File Upload Size Limit ( in MB )", 'multivendorx'),
	                            'id' => 'filesize-limit', 
	                            'is_enable'=> true,
	                            'description'=> __('Allows you to see the products put on sale by a seller', 'multivendorx'),
	                        ],
	                        [
	                            'variable'=> __("Captcha", 'multivendorx'),
	                            'id' => 'is-captcha', 
	                            'is_enable'=> true,
	                            'description'=> __('Displays the top rated products of the seller', 'multivendorx'),
	                        ],
	                   
	                    ],
	                    'database_value' => '',
	                ],
				]
			),
			'live-preview'  =>  array(
					'tablabel'      =>  __('Live Preview', 'multivendorx'),
					'icon'          =>  'icon-live-preview-tab',
					'class'			=>	'catalog-live-preview',
					'link'          =>  'https://wc-marketplace.com/product/woocommerce-catalog-enquiry-pro/',
			),
			'upgrade' =>  array(
					'tablabel'      =>  __('Upgrade To Pro For More Features', 'multivendorx'),
					'icon'          =>  'icon-upgrade-to-pro-tab',
					'class'			=>	'catalog-upgrade',
					'link'          =>  'https://wc-marketplace.com/product/woocommerce-catalog-enquiry-pro/',
			),
		);

		if (!empty($catalog_settings_page_endpoint)) {
            foreach ($catalog_settings_page_endpoint as $settings_key => $settings_value) {
                foreach ($settings_value['modulename'] as $inter_key => $inter_value) {
                    $change_settings_key    =   str_replace("-", "_", $settings_key);
                    $option_name = 'mvx_catalog_'.$change_settings_key.'_tab_settings';
                    $database_value = get_option($option_name) ? get_option($option_name) : array();
                    if (!empty($database_value)) {
                        if (isset($inter_value['key']) && array_key_exists($inter_value['key'], $database_value)) {
                            if (empty($inter_value['database_value'])) {
                               $catalog_settings_page_endpoint[$settings_key]['modulename'][$inter_key]['database_value'] = $database_value[$inter_value['key']];
                            }
                        }
                    }
                }
            }
        }

		$mvx_catalog_backend_tab_list = apply_filters('mvx_catalog_tab_list', array(
			'catalog-settings'      => $catalog_settings_page_endpoint,
		));

		return $mvx_catalog_backend_tab_list;
	}
}
