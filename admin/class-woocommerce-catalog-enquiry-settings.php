<?php
class Woocommerce_Catalog_Enquiry_Settings {
  
  private $tabs = array();
  
  private $options;
  
  /**
   * Start up
   */
  public function __construct() {
    // Admin menu
    add_action( 'admin_menu', array( $this, 'add_settings_page' ) );
    //add_action( 'admin_init', array( $this, 'settings_page_init' ) );
    add_action( 'admin_enqueue_scripts', array( $this, 'catalog_admin_enqueue_scripts' ) );
  }
  
  /**
   * Add options page
   */
  public function add_settings_page() {
    global $submenu;
    $slug = 'catalog';
    $dashboard = add_menu_page( __( 'catalog', 'multivendorx' ), __( 'catalog', 'multivendorx' ), 'manage_woocommerce', $slug, [ $this, 'mvx_catalog_callback' ],  'dashicons-store', 50 );
    add_submenu_page( 'catalog', __( 'Settings', 'catalog' ), __( 'Settings', 'catalog' ), 'manage_woocommerce', 'catalog#&tab=settings&subtab=general', '__return_null' );

    add_submenu_page( 'catalog', __( 'Dashboard', 'catalog' ), __( 'Dashboard', 'catalog' ), 'manage_woocommerce', 'catalog#&tab=dashboard', '__return_null' );

    remove_submenu_page( 'catalog', 'catalog' );


    if ( current_user_can( 'manage_woocommerce' ) ) {
      //$submenu[ $slug ][] = [ __( 'Settings', 'multivendorx' ), 'manage_woocommerce', 'admin.php?page=' . $slug . '#settings' ];
      //$submenu[ $slug ][] = [ __( '<div id="help-and-support">Help & Support</div>', 'multivendorx' ), 'manage_woocommerce', 'https://multivendorx.com/product/woocommerce-catalog-enquiry-pro/' ];
    }
  }

  public function mvx_catalog_callback() {
    echo '<div id="mvx-admin-catalog"></div>';
  }

  /**
   * Enqueue scripts and styles.
   *
   * @return void
   */
  public function catalog_admin_enqueue_scripts() {
    global $Woocommerce_Catalog_Enquiry;
    //print_r(get_current_screen()->id);die;
    if (get_current_screen()->id == 'toplevel_page_catalog') {
     
    wp_enqueue_style( 'mvx-catalog-style', $Woocommerce_Catalog_Enquiry->plugin_url . 'src/style/main.css' );
    wp_enqueue_script( 'mvx-catalog-script', $Woocommerce_Catalog_Enquiry->plugin_url . 'build/index.js', array( 'wp-element' ), '1.0.0', true );


    wp_localize_script( 'mvx-catalog-script', 'appLocalizer', apply_filters('catalog_settings', [
      'apiUrl' => home_url( '/wp-json' ),
      'nonce' => wp_create_nonce( 'wp_rest' ),
      
      // 'marker_icon' => $MVX->plugin_url . 'assets/images/store-marker.png',
      // 'mvx_logo' => $MVX->plugin_url.'assets/images/dclogo.svg',
      // 'google_api'    =>  get_mvx_global_settings('google_api_key'),
      // 'mapbox_api'    =>  get_mvx_global_settings('mapbox_api_key'),
      // 'location_provider'    =>  get_mvx_global_settings('choose_map_api'),
      // 'store_location_enabled'    =>  mvx_is_module_active('store-location'),
      // 'multivendor_right_white_logo' => $MVX->plugin_url.'assets/images/vertical-logo-white.png', 
      // 'knowledgebase' => 'https://multivendorx.com/knowledgebase/',
      // 'knowledgebase_title' => __('MVX knowledge Base', 'multivendorx'),
      // 'search_module' =>  __('Search Modules', 'multivendorx'),
      // 'marketplace_text' => __('MultiVendorX', 'multivendorx'),
      // 'search_module_placeholder' => __('Search Modules', 'multivendorx'),
      // 'pro_text' => __('Pro', 'multivendorx'),
      // 'documentation_extra_text' => __('For more info, please check the', 'multivendorx'),
      // 'documentation_text' => __('DOC', 'multivendorx'),
      // 'settings_text' => __('Settings', 'multivendorx'),
      // 'admin_mod_url' => admin_url('admin.php?page=modules'),
      // 'admin_setup_widget_option' => admin_url( 'index.php?page=mvx-setup' ),
      // 'admin_migration_widget_option' => admin_url( 'index.php?page=mvx-setup' ),
      // 'multivendor_migration_link' => admin_url('index.php?page=mvx-migrator'),
      // 'add_announcement_link' =>  admin_url('admin.php?page=mvx#&submenu=work-board&name=announcement&create=announcement'),
      // 'announcement_back' =>  admin_url('admin.php?page=mvx#&submenu=work-board&name=announcement'),
      // 'add_knowladgebase_link' =>  admin_url('admin.php?page=mvx#&submenu=work-board&name=knowladgebase&create=knowladgebase'),
      // 'knowladgebase_back' =>  admin_url('admin.php?page=mvx#&submenu=work-board&name=knowladgebase'),
      // 'settings_fields' => apply_filters('mvx-settings-fileds-details', $settings_fields),
      // 'countries'                 => wp_json_encode( array_merge( WC()->countries->get_allowed_country_states(), WC()->countries->get_shipping_country_states() ) ),
      // 'mvx_all_backend_tab_list' => $mvx_all_backend_tab_list,
      // 'default_logo'                  => $MVX->plugin_url.'assets/images/WP-stdavatar.png',
      // 'commission_bulk_list_option'   =>  $commission_bulk_list_action,
      // 'commission_header'             => $commission_header,
      // 'commission_status_list_action' =>  $commission_status_list_action,
      // 'commission_page_string'        =>  $commission_page_string,
      // 'vendor_page_string'            =>  $vendor_page_string,
      // 'status_and_tools_string'       =>  $status_and_tools_string,
      // 'settings_page_string'          =>  $settings_page_string,
      // 'global_string'                 =>  $global_string,
      // 'workboard_string'              =>  $workboard_string,
      // 'dashboard_string'              =>  $dashboard_page_string,
      // 'module_page_string'            =>  $module_page_string,
      // 'analytics_page_string'         =>  $analytics_page_string,
      // 'report_product_header'         =>  $report_product_header,
      // 'report_vendor_header'          =>  $report_vendor_header,
      // 'report_page_string'            =>  $report_page_string,
      // 'post_bulk_status'              =>  $post_bulk_status,
      // 'question_selection_wordpboard' =>  $question_selection_wordpboard,
      // 'question_product_selection_wordpboard' =>  $question_product_selection_wordpboard,
      // 'pending_question_bulk'         =>  $pending_question_bulk,
      // 'task_board_bulk_status'        =>  $task_board_bulk_status,
      // 'columns_announcement'          =>  $columns_announcement,
      // 'columns_questions'             =>  $columns_questions,
      // 'columns_knowledgebase'         =>  $columns_knowledgebase,
      // 'columns_store_review'          =>  $columns_store_review,
      // 'columns_vendor'                =>  $columns_vendor,
      // 'columns_followers'             =>  $columns_followers,
      // 'columns_zone_shipping'         =>  $columns_zone_shipping,
      // 'select_option_delete'          =>  $select_option_delete,
      // 'columns_commission'                    =>  $columns_commission,
      // 'columns_report_abuse'                  =>  $columns_report_abuse,
      // 'columns_refund_request'                =>  $columns_refund_request,
      // 'columns_pending_shipping'              =>  $columns_pending_shipping,
      // 'select_module_category_option'         =>  $select_module_category_option,
      // 'errors_log'                            =>  $this->get_error_log_rows(100),
      //'mvx_tinymce_key'                       =>  get_mvx_vendor_settings('mvx_tinymce_api_section', 'settings_general')

      //'tab-content' => mvx_catalog_admin_tabs() 



  ] ) );


    }
  }
  
}