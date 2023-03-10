<?php
class Woocommerce_Catalog_Enquiry_Settings {
      
  /**
   * Start up
   */
  public function __construct() {
    // Admin menu
    add_action( 'admin_menu', array( $this, 'add_settings_page' ) );
    add_action( 'admin_enqueue_scripts', array( $this, 'catalog_admin_enqueue_scripts' ) );
  }
  
  /**
   * Add options page
   */
  public function add_settings_page() {
    global $submenu;
    $slug = 'catalog';
    $dashboard = add_menu_page( __( 'catalog', 'multivendorx' ), __( 'Catalog', 'multivendorx' ), 'manage_woocommerce', $slug, [ $this, 'mvx_catalog_callback' ],  'data:image/svg+xml;base64,' . base64_encode('<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><g fill="#9EA3A8" fill-rule="nonzero"><path d="M7.8,5.4c0,0.5-0.4,0.9-0.9,0.9C6.6,6.3,6.3,6,6.1,5.7c0-0.1-0.1-0.2-0.1-0.3    c0-0.5,0.4-0.9,0.9-0.9c0.1,0,0.2,0,0.3,0.1C7.6,4.7,7.8,5,7.8,5.4z M5,7.4c-0.1,0-0.2,0-0.2,0c-0.6,0-1.1,0.5-1.1,1.1    C3.6,9,4,9.4,4.4,9.6c0.1,0,0.2,0.1,0.3,0.1c0.6,0,1.1-0.5,1.1-1.1C5.9,7.9,5.5,7.5,5,7.4z M5.8,1.7c-0.6,0-1,0.5-1,1s0.5,1,1,1    s1-0.5,1-1S6.3,1.7,5.8,1.7z M2.9,2.1c-0.3,0-0.5,0.2-0.5,0.5s0.2,0.5,0.5,0.5s0.5-0.2,0.5-0.5S3.2,2.1,2.9,2.1z M0.8,5.7    C0.3,5.7,0,6.1,0,6.5s0.3,0.8,0.8,0.8s0.8-0.3,0.8-0.8S1.2,5.7,0.8,5.7z M20,10.6c-0.1,4.3-3.6,7.7-7.9,7.7c-1.2,0-2.3-0.3-3.4-0.7    l-3.5,0.6l1.4-2c-1.5-1.4-2.5-3.5-2.5-5.7c0-0.2,0-0.4,0-0.5c0.3,0.1,0.6,0.1,0.9,0C5.9,9.7,6.4,9,6.3,8.3c0-0.2-0.1-0.4-0.2-0.5    C5.7,7,4.9,6.8,4.2,6.9C4,7,3.8,7,3.7,7C3,6.9,2.5,6.4,2.4,5.8c-0.2-1,0.6-1.9,1.6-1.9C4.6,4,5.1,4.4,5.3,5c0,0.1,0,0.2,0,0.2    c0.1,0.5,0.4,1,0.9,1.2c0.2,0.1,0.5,0.2,0.7,0.2c0.7,0,1.3-0.6,1.3-1.3c0-0.5-0.3-1-0.8-1.2c1.4-1.1,3.2-1.7,5.1-1.6    C16.7,2.8,20.1,6.3,20,10.6z M14.9,8.2c0-0.3-0.2-0.5-0.5-0.5H9.9c-0.3,0-0.5,0.2-0.5,0.5v4.6c0,0.3,0.2,0.5,0.5,0.5h2.6l0.5,1.1    h1.2l-0.5-1.1h0.9c0.3,0,0.5-0.2,0.5-0.5V8.2z M10.4,12.2h1.6l-0.3-0.6l0.9-0.4l0.5,1h0.8V8.7h-3.5V12.2z"/></g></svg>'), 50 );

    if (apply_filters('mvx_catalog_add_query', false)) {
      add_submenu_page( 'catalog', __( 'Customer Queries', 'catalog' ), __( 'Customer Queries', 'catalog' ), 'manage_woocommerce', 'catalog#&tab=customer&subtab=queries', '__return_null' );
    }
    add_submenu_page( 'catalog', __( 'Settings', 'catalog' ), __( 'Settings', 'catalog' ), 'manage_woocommerce', 'catalog#&tab=settings&subtab=general', '__return_null' );

    if (apply_filters('mvx_catalog_free_only_active', true)) {
      $submenu[ $slug ][] = [ __( '<div id="upgrade-to-pro"><i class="mvx-catalog icon-upgrade-to-pro-tab"></i>Upgrade to pro</div>', 'multivendorx' ), 'manage_woocommerce', 'https://multivendorx.com/pricing' ];
    }
    
    remove_submenu_page( 'catalog', 'catalog' );
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

    if (get_current_screen()->id == 'toplevel_page_catalog') {
      wp_enqueue_style( 'mvx-catalog-style', $Woocommerce_Catalog_Enquiry->plugin_url . 'src/style/main.css' );
      wp_enqueue_script( 'mvx-catalog-script', $Woocommerce_Catalog_Enquiry->plugin_url . 'build/index.js', array( 'wp-element' ), '1.0.0', true );
      $settings_page_string = array(
            'registration_form_title'       =>  __('Registration form title', 'multivendorx'),
            'registration_form_title_desc'  =>  __('Type the form title you want the vendor to see. eg registrazione del venditore', 'multivendorx'),
            'registration_form_desc'        =>  __('Registration form description', 'multivendorx'),
            'registration1'                  =>  __('Introduce your marketplace or add instructions for registration', 'multivendorx'),
            'registration2'                  =>  __('Write questions applicable to your marketplace', 'multivendorx'),
            'registration3'                  =>  __('Select your preferred question format. Read doc to know more about each format.', 'multivendorx'),
            'registration4'                  =>  __('Placeholder', 'multivendorx'),
            'registration5'                  =>  __('Tooltip description', 'multivendorx'),
            'registration6'                  =>  __('Leave this section blank or add examples of an answer here.', 'multivendorx'),
            'registration7'                  =>  __('Add more information or specific instructions here.', 'multivendorx'),
            'registration8'                  =>  __('Characters Limit', 'multivendorx'),
            'registration9'                  =>  __('Restrict vendor descriptions to a certain number of characters.', 'multivendorx'),
            'registration11'                  =>  __('Multiple', 'multivendorx'),
            'registration12'                  =>  __('Maximum file size', 'multivendorx'),
            'registration13'                  =>  __('Add limitation for file size', 'multivendorx'),
            'registration14'                  =>  __('Acceptable file types', 'multivendorx'),
            'registration15'                  =>  __('Choose preferred file size.', 'multivendorx'),
            'registration16'                  =>  __('reCAPTCHA Type', 'multivendorx'),
            'registration17'                  =>  __('reCAPTCHA v3', 'multivendorx'),
            'registration18'                  =>  __('reCAPTCHA v2', 'multivendorx'),
            'registration19'                  =>  __('Site key', 'multivendorx'),
            'registration20'                  =>  __('Secret key', 'multivendorx'),
            'registration21'                  =>  __('Recaptcha Script', 'multivendorx'),
            'registration22'                  =>  __('Write titles for your options here.', 'multivendorx'),
            'registration23'                  =>  __('This section is available for developers who might want to mark the labels they create.', 'multivendorx'),
            'registration24'                  =>  __('', 'multivendorx'),
            'registration25'                  =>  __('Require', 'multivendorx'),
            'registration26'                  =>  __('To get', 'multivendorx'),
            'registration27'                  =>  __('reCAPTCHA', 'multivendorx'),
            'registration28'                  =>  __('script, register your site with google account', 'multivendorx'),
            'registration29'                  =>  __('Register', 'multivendorx'),
            'question-format'                 => array(
                array(
                    'icon'  =>  'icon-select-question-type',
                    'value' => 'select_question_type',
                    'label' =>  __('Select question type', 'multivendorx')
                ),
                array(
                    'icon'  =>  'icon-form-textbox',
                    'value' => 'textbox',
                    'label' =>  __('Textbox', 'multivendorx')
                ),
                array(
                    'icon'  =>  'icon-form-email',
                    'value' => 'email',
                    'label' =>  __('Email', 'multivendorx')
                ),
                array(
                    'icon'  =>  'icon-form-url',
                    'value' => 'url',
                    'label' =>  __('Url', 'multivendorx')
                ),
                array(
                    'icon'  =>  'icon-form-textarea',
                    'value' => 'textarea',
                    'label' =>  __('Textarea', 'multivendorx')
                ),
                array(
                    'icon'  =>  'icon-form-checkboxes',
                    'value' => 'checkboxes',
                    'label' =>  __('Checkboxes', 'multivendorx')
                ),
                array(
                    'icon'  =>  'icon-form-multi-select',
                    'value' => 'multi-select',
                    'label' =>  __('Multi Select', 'multivendorx')
                ),
                array(
                    'icon'  =>  'icon-form-radio',
                    'value' => 'radio',
                    'label' =>  __('Radio', 'multivendorx')
                ),
                array(
                    'icon'  =>  'icon-form-dropdown',
                    'value' => 'dropdown',
                    'label' =>  __('Dropdown', 'multivendorx')
                ),
                array(
                    'icon'  =>  'icon-form-recaptcha',
                    'value' => 'recapta',
                    'label' =>  __('Recapta', 'multivendorx')
                ),
                array(
                    'icon'  =>  'icon-form-attachment',
                    'value' => 'attachment',
                    'label' =>  __('Attachment', 'multivendorx')
                ),
                array(
                    'icon'  =>  'icon-form-section',
                    'value' => 'section',
                    'label' =>  __('Section', 'multivendorx')
                ),
                array(
                    'icon'  =>  'icon-form-store-description',
                    'value' => 'vendor_description',
                    'label' =>  __('Store Description', 'multivendorx')
                ),
                array(
                    'icon'  =>  'icon-form-address01',
                    'value' => 'vendor_address_1',
                    'label' =>  __('Address 1', 'multivendorx')
                ),
                array(
                    'icon'  =>  'icon-form-address02',
                    'value' => 'vendor_address_2',
                    'label' =>  __('Address 2', 'multivendorx')
                ),
                array(
                    'icon'  =>  'icon-form-phone',
                    'value' => 'vendor_phone',
                    'label' =>  __('Phone', 'multivendorx')
                ),
                array(
                    'icon'  =>  'icon-form-country',
                    'value' => 'vendor_country',
                    'label' =>  __('Country', 'multivendorx')
                ),
                array(
                    'icon'  =>  'icon-form-state',
                    'value' => 'vendor_state',
                    'label' =>  __('State', 'multivendorx')
                ),
                array(
                    'icon'  =>  'icon-form-city',
                    'value' => 'vendor_city',
                    'label' =>  __('City', 'multivendorx')
                ),
                array(
                    'icon'  =>  'icon-form-postcode',
                    'value' => 'vendor_postcode',
                    'label' =>  __('Postcode', 'multivendorx')
                ),
                array(
                    'icon'  =>  'icon-form-paypal-email',
                    'value' => 'vendor_paypal_email',
                    'label' =>  __('PayPal Email', 'multivendorx')
                )
            )
        );
      wp_localize_script( 'mvx-catalog-script', 'catalogappLocalizer', apply_filters('catalog_settings', [
        'apiUrl' => home_url( '/wp-json' ),
        'nonce' => wp_create_nonce( 'wp_rest' ),
        'banner_img'  => $Woocommerce_Catalog_Enquiry->plugin_url . 'assets/images/catalog-pro-add-admin-banner.jpg',
        'settings_page_string'  =>  $settings_page_string,
        'pro_active'    =>  apply_filters('mvx_catalog_free_only_active', true)
      ] ) );
    }
  }
  
}