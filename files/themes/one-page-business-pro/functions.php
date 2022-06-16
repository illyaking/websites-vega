<?php 
require_once( get_template_directory() . '/cyberchimps/init.php' );

if ( get_transient('cc_validate_user_details') === false)
{
	$cc_user_login_id = get_option("cc_account_user_details");

	if ( $cc_user_login_id != '' ) { 
		$username = $cc_user_login_id['username'];	$password = $cc_user_login_id['password'];

		require_once( get_template_directory() . '/cyberchimps/class-cc-updater.php');
		if(isset($username) && isset($password) ) {
			$ccuser = new CC_Updater($username, $password );
			$ccuser->validate();
			set_transient('cc_validate_user_details' , 'validate_user' , WEEK_IN_SECONDS);
		}
	}
}

//Title tag should not be used
 function one_page_business_pro_slug_setup()
 {
 add_theme_support( 'title-tag' );
 }
add_action( 'after_setup_theme', 'one_page_business_pro_slug_setup' ); 


function one_page_business_pro_setup() {
    load_theme_textdomain( 'cyberchimps', get_template_directory() . '/languages' );
    if ( ! isset( $content_width ) ) $content_width = 900;
}

add_action( 'after_setup_theme', 'one_page_business_pro_setup' );




// Notify user of theme update on "Updates" page in Dashboard.
$cc_user_account_status = get_option("cc_account_status");
if (isset ( $cc_user_account_status ) && $cc_user_account_status == 'found' ) {
	require_once('wp-updates-theme.php'); 
	new WPUpdatesThemeUpdater_1858( 'http://wp-updates.com/api/2/theme', basename( get_template_directory() ) );
}





function one_page_business_pro_name_scripts() {

// Bootstrap
     wp_enqueue_style( 'theme-font-awesome-css', get_template_directory_uri() . '/fonts/font-awesome/css/font-awesome.css' );

// Slider
    wp_enqueue_style( 'theme-carousel-css', get_template_directory_uri() . '/css/owl.carousel.css' );
    wp_enqueue_style( 'theme-owltheme-css', get_template_directory_uri() . '/css/owl.theme.css' );
    wp_enqueue_style( 'theme-animate-css', get_template_directory_uri() . '/css/animate.min.css' );
  
// JS Files
    wp_enqueue_script('jquery');
    wp_enqueue_script( 'script-modernizr', get_template_directory_uri() .'/js/modernizr.custom.js' ); 
    wp_enqueue_script( 'script-wow', get_template_directory_uri() .'/js/wow.min.js' );
    wp_enqueue_script( 'script-custom', get_template_directory_uri() .'/js/custom.js');
    wp_enqueue_script( 'script-prettyPhoto', get_template_directory_uri() .'/js/jquery.prettyPhoto.js' );
    wp_enqueue_script( 'script-isotope', get_template_directory_uri() .'/js/jquery.isotope.js');
    wp_enqueue_script( 'script-jqBootstrapValidation', get_template_directory_uri() .'/js/jqBootstrapValidation.js');
    wp_enqueue_script( 'carousel-owl', get_template_directory_uri() . '/js/owl.carousel.js');
  
  }
  
add_action( 'wp_enqueue_scripts', 'one_page_business_pro_name_scripts' );

include( get_template_directory().'/inc/custom/custom-function.php' );


/* add theme option in backend code start*/
function cyberchimps_theme_check() {
    $level = 'pro';
    return $level;
}
//Theme Name
function one_page_business_pro_options_theme_name(){
	$text = 'One Page Business Pro ';
	return $text;
}
add_filter( 'cyberchimps_current_theme_name', 'one_page_business_pro_options_theme_name', 1 );

/* Enqueue Google font  */
function wpb_add_google_fonts() {
	wp_enqueue_style( 'wpb-google-fonts', 'http://fonts.googleapis.com/css?family=Lato:400,700,900,300', true );
	wp_enqueue_style( 'wpb-google-fonts', 'http://fonts.googleapis.com/css?family=Open+Sans:400,700,800,600,300', true );
	}
	add_action( 'wp_enqueue_scripts', 'wpb_add_google_fonts' );





/* add theme option in backend code ends*/

function one_page_business_pro_add_core_headings( $headings_list ) {

	$headings_list = array();

	$headings_list[] = array(
			'id'    => 'cyberchimps_design_heading_one_page_business_pro',
			'title' => __( 'Design', 'cyberchimps_core' ),
	);
	
	$headings_list[] = array(
		'id'    => 'cyberchimps_header_heading_one_page_business_pro',
		'title' => __( 'Header', 'cyberchimps_core' ),
	);
	$headings_list[] = array(
			'id'    => 'cyberchimps_sections_heading_one_page_business_pro',
			'title' => __( 'Sections', 'cyberchimps_core' ),
	);
	$headings_list[] = array(
		'id'    => 'cyberchimps_footer_heading',
		'title' => __( 'Footer', 'cyberchimps_core' ),
	);
	$headings_list[] = array(
		'id'    => 'cyberchimps_import_export_heading',
		'title' => __( 'Import/Export', 'cyberchimps_elements' ),
	);
	return apply_filters( 'cyberchimps_headings_filter', $headings_list );
}


// *************** Navbar image ******************

// Set header drag and drop default to Logo  ----
function one_page_business_pro_header_drag_and_drop_default() {
    return array( 'cyberchimps_sitename_contact' => __( 'Logo', 'one-page-business-pro' ) );
}
add_filter( 'header_drag_and_drop_default', 'one_page_business_pro_header_drag_and_drop_default', 20 );
//*************************************************



// Filter added for Help Section URL Changes 
function one_page_business_pro_help_url_doc(){
	$url='http://cyberchimps.com/guides/';
	return $url;
}
function one_page_business_pro_help_url_forum(){
	$url='http://cyberchimps.com/forum/pro/one-page-business-pro/';
	return $url;
}

add_filter( 'cyberchimps_documentation', 'one_page_business_pro_help_url_doc' );
add_filter( 'cyberchimps_support_forum', 'one_page_business_pro_help_url_forum');


function one_page_business_pro_header(){
	remove_filter( 'cyberchimps_heading_list', 'cyberchimps_add_core_headings' );
	remove_filter( 'cyberchimps_headings_filter', 'cyberchimps_addons_headings', 20, 1 );
    remove_filter( 'cyberchimps_headings_filter', 'cyberchimps_add_headings', 1 );
}
add_action('admin_init', 'one_page_business_pro_header');

add_filter( 'cyberchimps_heading_list', 'one_page_business_pro_add_core_headings' );



//add sections and the position in that heading
function one_page_business_pro_add_sections( $original ) {

  /************************ DESIGN *******************************/
	
	$new_section[][1] = array(
			'id'      => 'cyberchimps_custom_colors_section',
			'label'   => __( 'Custom Colors', 'cyberchimps_core' ),
			'heading' => 'cyberchimps_design_heading_one_page_business_pro'
	);
	
	$new_section[][2] = array(
			'id'      => 'cyberchimps_typography_section',
			'label'   => __( 'Typography', 'cyberchimps_core' ),
			'heading' => 'cyberchimps_design_heading_one_page_business_pro'
	);
	
	$new_section[][3] = array(
			'id' => 'cyberchimps_custom_css_section',
			'label' => __('Custom CSS', 'cyberchimps_core' ),
			'heading' => 'cyberchimps_design_heading_one_page_business_pro'
	);
	
	
	
	
  /**************************** HEADER *********************************/
	
    $new_section[][1] = array(
            'id'      => 'cyberchimps_header_layout_section_one_page_business_pro',
            'label'   => __( 'Header Layout Option', 'cyberchimps_elements' ),
            'heading' => 'cyberchimps_header_heading_one_page_business_pro'
    );
   
    
    $new_section[][9] = array(
    		'id'      => 'cyberchimps_header_drag_drop_section',
    		'label'   => __( 'Header Drag &#38; Drop', 'cyberchimps_core' ),
    		'heading' => 'cyberchimps_header_heading_one_page_business_pro'
    );
    
    $new_section[][10] = array(
    		'id'      => 'cyberchimps_header_options_section',
    		'label'   => __( 'Header Options', 'cyberchimps_core' ),
    		'heading' => 'cyberchimps_header_heading_one_page_business_pro'
    );
    
    
  /**************************** SERVICES *********************************/
    
    
    $new_section[][2] = array(
            'id'      => 'cyberchimps_services_section_one_page_business_pro',
            'label'   => __( 'Services', 'cyberchimps_elements' ),
            'heading' => 'cyberchimps_sections_heading_one_page_business_pro'
    ); 
    
  /**************************** PORTFOLIO *********************************/
    
     $new_section[][3] = array(
            'id'      => 'cyberchimps_portfolio_section_one_page_business_pro',
            'label'   => __( 'Portfolio', 'cyberchimps_elements' ),
            'heading' => 'cyberchimps_sections_heading_one_page_business_pro'
    );
     
     
  /**************************** ABOUT US **********************************/
     
    $new_section[][4] = array(
            'id'      => 'cyberchimps_aboutus_section_one_page_business_pro',
            'label'   => __( 'About us', 'cyberchimps_elements' ),
            'heading' => 'cyberchimps_sections_heading_one_page_business_pro'
    );
    
 /**************************** TEAM LAYOUT *********************************/
    
    $new_section[][5] = array(
            'id'      => 'cyberchimps_team_section_one_page_business_pro',
            'label'   => __( 'Team', 'cyberchimps_elements' ),
            'heading' => 'cyberchimps_sections_heading_one_page_business_pro'
    );
    
    
 /**************************** TESTIMONIAL *********************************/
    
    $new_section[][6] = array(
            'id'      => 'cyberchimps_testimonial_section_one_page_business_pro',
            'label'   => __( 'Testimonial', 'cyberchimps_elements' ),
            'heading' => 'cyberchimps_sections_heading_one_page_business_pro'
    );
    
    
  /**************************** CONTACT ***********************************/
     $new_section[][7] = array(
            'id'      => 'cyberchimps_contact_section_one_page_business_pro',
            'label'   => __( 'Contact us', 'cyberchimps_elements' ),
            'heading' => 'cyberchimps_sections_heading_one_page_business_pro'
    );
    
    
    $new_sections = cyberchimps_array_section_organizer( $original, apply_filters( 'cyberchimps_pro_header_sections', $new_section ) );

    return $new_sections;
}
add_filter( 'cyberchimps_sections_filter', 'one_page_business_pro_add_sections', 1 );

//add fields to the section of one_page_business_pro


function one_page_business_pro_add_fields( $original ) {
    
	$directory_uri = get_template_directory_uri();
	$options_boxes_cats = array();
    $boxes_terms        = get_terms( 'boxes_categories', 'hide_empty=0' );
    if ( !is_wp_error( $boxes_terms ) ):
        foreach ( $boxes_terms as $term ) {
            $options_boxes_cats[$term->slug] = $term->name;
        }
    endif;
	
    
    /*************************** DESIGN *********************************/
    
    /* LAYOUT OPTIONS */
    
    $new_field[][1] = array(
    		'name'    => __( 'Responsive Design', 'cyberchimps_core' ),
    		'id'      => 'responsive_design',
    		'type'    => 'toggle',
    		'std'     => 'checked',
    		'section' => 'cyberchimps_custom_layout_section',
    		'heading' => 'cyberchimps_design_heading_one_page_business_pro'
    );
    
    $new_field[][2] = array(
    		'name'    => __( 'Responsive Videos', 'cyberchimps_core' ),
    		'id'      => 'responsive_videos',
    		'type'    => 'toggle',
    		'section' => 'cyberchimps_custom_layout_section',
    		'heading' => 'cyberchimps_design_heading_one_page_business_pro'
    );
    
    $new_field[][3] = array(
    		'name'    => __( 'Gallery Lightbox', 'cyberchimps_core' ),
    		'id'      => 'gallery_lightbox',
    		'type'    => 'toggle',
    		'std'     => 'checked',
    		'section' => 'cyberchimps_custom_layout_section',
    		'heading' => 'cyberchimps_design_heading_one_page_business_pro'
    );

    
    $new_field[][4] = array(
    		'name'    => __( 'Max Width', 'cyberchimps_core' ),
    		'id'      => 'max_width',
    		'class'   => '',
    		'std'     => apply_filters('max_width_default','1020'),
    		'desc'    => __( 'enter the width of your site in pixels', 'cyberchimps_core' ),
    		'type'    => 'text',
    		'section' => 'cyberchimps_custom_layout_section',
    		'heading' => 'cyberchimps_design_heading_one_page_business_pro'
    );
    

      /* CUSTOM COLORS */
    $new_field[][5] = array(
    		'name'    => __( 'Select a Skin Color', 'cyberchimps_core' ),
    		'id'      => 'cyberchimps_skin_color',
    		'std'     => 'default',
    		'type'    => 'images',
    		'options' => apply_filters( 'cyberchimps_skin_color', array(
    				'default' => $directory_uri . '/inc/css/skins/images/default.png'
    		) ),
    		'section' => 'cyberchimps_custom_colors_section',
    		'heading' => 'cyberchimps_design_heading_one_page_business_pro'
    );
    

    
    $new_field[][6] = array(
    		'name'    => __( 'Text Color', 'cyberchimps_core' ),
    		'desc'    => __( 'Select text color', 'cyberchimps_core' ),
    		'id'      => 'text_colorpicker',
    		'std'     => '',
    		'type'    => 'color',
    		'section' => 'cyberchimps_custom_colors_section',
    		'heading' => 'cyberchimps_design_heading_one_page_business_pro'
    );
    
    $new_field[][7] = array(
    		'name'    => __( 'Link Color', 'cyberchimps_core' ),
    		'desc'    => __( 'Select link color', 'cyberchimps_core' ),
    		'id'      => 'link_colorpicker',
    		'std'     => '',
    		'type'    => 'color',
    		'section' => 'cyberchimps_custom_colors_section',
    		'heading' => 'cyberchimps_design_heading_one_page_business_pro'
    );
    
    $new_field[][8] = array(
    		'name'    => __( 'Link Hover Color', 'cyberchimps_core' ),
    		'desc'    => __( 'Select link hover color', 'cyberchimps_core' ),
    		'id'      => 'link_hover_colorpicker',
    		'std'     => '',
    		'type'    => 'color',
    		'section' => 'cyberchimps_custom_colors_section',
    		'heading' => 'cyberchimps_design_heading_one_page_business_pro'
    );

    $new_field[][20] = array(
    		'name'    => __( 'Menu Text Color', 'cyberchimps_core' ),
    		'desc'    => __( 'Select menu text color', 'cyberchimps_core' ),
    		'id'      => 'menu_text_colorpicker',
    		'std'     => '',
    		'type'    => 'color',
    		'section' => 'cyberchimps_custom_colors_section',
    		'heading' => 'cyberchimps_design_heading_one_page_business_pro'
    );
    
    $new_field[][21] = array(
    		'name'    => __( 'Menu Hover Color', 'cyberchimps_core' ),
    		'desc'    => __( 'Select menu hover color', 'cyberchimps_core' ),
    		'id'      => 'menu_hover_text_colorpicker',
    		'std'     => '',
    		'type'    => 'color',
    		'section' => 'cyberchimps_custom_colors_section',
    		'heading' => 'cyberchimps_design_heading_one_page_business_pro'
    );



    /* Typography Options */
    /* Default font faces */
    $faces                      = array(
    		'Arial, Helvetica, sans-serif'                     => 'Arial',
    		'Arial Black, Gadget, sans-serif'                  => 'Arial Black',
    		'Comic Sans MS, cursive'                           => 'Comic Sans MS',
    		'Courier New, monospace'                           => 'Courier New',
    		'Georgia, serif'                                   => 'Georgia',
    		'"Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif'     => 'Helvetica Neue',
    		'Impact, Charcoal, sans-serif'                     => 'Impact',
    		'Lucida Console, Monaco, monospace'                => 'Lucida Console',
    		'Lucida Sans Unicode, Lucida Grande, sans-serif'   => 'Lucida Sans Unicode',
    		'"Open Sans", sans-serif'                          => 'Open Sans',
    		'Palatino Linotype, Book Antiqua, Palatino, serif' => 'Palatino Linotype',
    		'Tahoma, Geneva, sans-serif'                       => 'Tahoma',
    		'Times New Roman, Times, serif'                    => 'Times New Roman',
    		'Trebuchet MS, sans-serif'                         => 'Trebuchet MS',
    		'Verdana, Geneva, sans-serif'                      => 'Verdana',
    		'Symbol'                                           => 'Symbol',
    		'Webdings'                                         => 'Webdings',
    		'Wingdings, Zapf Dingbats'                         => 'Wingdings',
    		'MS Sans Serif, Geneva, sans-serif'                => 'MS Sans Serif',
    		'MS Serif, New York, serif'                        => 'MS Serif',
    		'Google Fonts'                                     => 'Google Fonts'
    );
    $typography_options         = array(
    		'sizes'  => apply_filters( 'cyberchimps_typography_sizes', array( '8', '10', '12', '14', '16', '20' ) ),
    		'faces'  => apply_filters( 'cyberchimps_typography_faces', $faces ),
    		'styles' => apply_filters( 'cyberchimps_typography_styles', array( 'normal' => 'Normal', 'bold' => 'Bold' ) ),
    		'color'  => false
    );
    $typography_heading_options = array(
    		'sizes'  => false,
    		'faces'  => apply_filters( 'cyberchimps_typography_faces', $faces ),
    		'styles' => false,
    		'color'  => false
    );
    
    /* Typography Section */
    
    
    // Typography Defaults
    $typography_defaults = apply_filters( 'cyberchimps_typography_defaults', array(
    		'size'  => '14px',
    		'face'  => 'Arial, Helvetica, sans-serif',
    		'style' => 'normal',
    		'color' => '#333333'
    ) );
    
    // Heading Typography Defaults
    $typography_heading_defaults = apply_filters( 'cyberchimps_typography_heading_defaults', array(
    		'size'  => '',
    		'face'  => 'Arial, Helvetica, sans-serif',
    		'style' => '',
    		'color' => ''
    ) );
    
    $new_field[][9] = array(
    		'id'      => 'typography_options',
    		'name'    => __( 'Typography Options', 'cyberchimps_core' ),
    		'type'    => 'typography',
    		'std'     => $typography_defaults,
    		'options' => $typography_options,
    		'section' => 'cyberchimps_typography_section',
    		'heading' => 'cyberchimps_design_heading_one_page_business_pro'
    );
    
    // Entry field for google font
    $new_field[][10] = array(
    		'name'    => __( 'Enter Google font', 'cyberchimps_core' ),
    		'id'      => 'google_font_field',
    		'type'    => 'text',
    		'std'     => apply_filters( 'cyberchimps_typography_google_default', '' ),
    		'desc'    => __( 'Google font names are case sensitive', 'cyberchimps_core' ),
    		'section' => 'cyberchimps_typography_section',
    		'heading' => 'cyberchimps_design_heading_one_page_business_pro'
    );
    
    $new_field[][11] = array(
    		'name'    => __( 'Demo Text', 'cyberchimps_core' ),
    		'id'      => 'font_demo_text',
    		'type'    => 'info',
    		'desc'    => 'The quick CyberChimp jumps over the lazy dog',
    		'section' => 'cyberchimps_typography_section',
    		'heading' => 'cyberchimps_design_heading_one_page_business_pro'
    );
    
    // Font Family for headings.
    $new_field[][12] = array(
    		'name'    => __( 'Font Family for headings', 'cyberchimps_core' ),
    		'id'      => 'font_family_headings',
    		'type'    => 'typography',
    		'std'     => $typography_heading_defaults,
    		'options' => $typography_heading_options,
    		'section' => 'cyberchimps_typography_section',
    		'heading' => 'cyberchimps_design_heading_one_page_business_pro'
    );
    
  /*  // Google Font for headings.
    $new_field[][13] = array(
    		'name'    => __( 'Google font for headings', 'cyberchimps_core' ),
    		'id'      => 'google_font_headings',
    		'type'    => 'text',
    		'std'     => apply_filters( 'cyberchimps_typography_heading_google_default', '' ),
    		'desc'    => __( 'Google font names are case sensitive', 'cyberchimps_core' ),
    		'section' => 'cyberchimps_typography_section',
    		'heading' => 'cyberchimps_design_heading_one_page_business_pro'
    );
    
    */
    
    $new_field[][14] = array(
    		'name'    => __( 'Custom CSS', 'cyberchimps_elements' ),
    		'id'      => 'custom_css',
    		'std'     => '',
    		'type'    => 'csstextarea',
    		'section' => 'cyberchimps_custom_css_section',
    		'heading' => 'cyberchimps_design_heading_one_page_business_pro'
    );
	
	
  /****************************Header section*********************************/
	
    $new_field[][15] = array(
            'name'    => __( 'Menu Title Header', 'cyberchimps_elements' ),
            'id'      => 'menu_title_header',
            'class'   => '',
            'std'     => apply_filters('max_width_default','Home'),
            'desc'    => __( 'Enter the title for header', 'cyberchimps_elements' ),
            'type'    => 'text',
            'section' => 'cyberchimps_header_layout_section_one_page_business_pro',
            'heading' => 'cyberchimps_header_heading_one_page_business_pro'
    );
    $new_field[][16] = array(
            'name'    => __( 'Header Title', 'cyberchimps_elements' ),
            'id'      => 'header_title',
            'class'   => '',
            'std'     => apply_filters('max_width_default','We are Growing'),
            'desc'    => __( 'Enter the title for header section', 'cyberchimps_elements' ),
            'type'    => 'textarea',
            'section' => 'cyberchimps_header_layout_section_one_page_business_pro',
            'heading' => 'cyberchimps_header_heading_one_page_business_pro'
    );
    $new_field[][17] = array(
            'name'    => __( 'Header Description', 'cyberchimps_elements' ),
            'id'      => 'header_desc',
            'std'     => apply_filters('max_width_default','a creative digital agency from New York'),
            'type'    => 'textarea',
            'desc'    => __( 'Enter the description for header section', 'cyberchimps_elements' ),
            'section' => 'cyberchimps_header_layout_section_one_page_business_pro',
            'heading' => 'cyberchimps_header_heading_one_page_business_pro'
    );
    $new_field[][18] = array(
             'name' => __('Background Image', 'cyberchimps_elements' ),
             'desc' => __('Enter URL or upload file', 'cyberchimps_elements' ),
             'id' => 'custom_background_image_for_header',             
             'type' => 'upload',
             'std'     => $directory_uri . apply_filters( 'cyberchimps_boxes_lite_img1', '/img/header-bg.jpg' ),             
			 'section' => 'cyberchimps_header_layout_section_one_page_business_pro',
             'heading' => 'cyberchimps_header_heading_one_page_business_pro'
    );

   $new_field[][20] = array(
            'name'    => __( 'Header Button Title', 'cyberchimps_elements' ),
            'id'      => 'header_button_title',
            'class'   => '',
            'std'     => apply_filters('max_width_default','Home'),
            'desc'    => __( 'Enter the title for header button', 'cyberchimps_elements' ),
            'type'    => 'text',
            'section' => 'cyberchimps_header_layout_section_one_page_business_pro',
            'heading' => 'cyberchimps_header_heading_one_page_business_pro'
    );
    
  $options_section_cats = array(
				cyberchimps_get_option('menu_title_about'),
				cyberchimps_get_option('menu_title_services'),
				cyberchimps_get_option('menu_title_portfolio'),
				cyberchimps_get_option('menu_title_team'),
				cyberchimps_get_option('menu_title_testimonial'),
				cyberchimps_get_option('menu_title_contact')	
			);
    
  if ( $options_section_cats ) {
    	$new_field[][21] = array(
    			'name'    => __( 'Select section category for button', 'one-page-business-pro' ),
    			'id'      => 'button_category',
    			'type'    => 'select',
			'desc'    => 'To which button will point',
    			'options' => $options_section_cats,
    			'section' => 'cyberchimps_header_layout_section_one_page_business_pro',
            		'heading' => 'cyberchimps_header_heading_one_page_business_pro'
    	);
    }

  
    $new_field[][19] = array(
    		'id'       => 'header_section_order',
    		'name'     => __( 'Header Drag/Drop', 'cyberchimps_core' ),
    		'callback' => 'cyberchimps_drag_drop_field',
    		'std'      => apply_filters( 'header_drag_and_drop_default', array(
    				'cyberchimps_header_content' => __( 'Logo + Icons', 'cyberchimps_core' )
    		) ),
    		'type'     => 'section_order',
    		'options'  => apply_filters( 'header_drag_and_drop_options', array(
    				'cyberchimps_header_content' => __( 'Logo + Icons', 'cyberchimps_core' ),
    				'cyberchimps_logo_search'    => __( 'Logo + Search', 'cyberchimps_core' ),
    				'cyberchimps_logo'           => __( 'Logo', 'cyberchimps_core' )
    		) ),
    		'section'  => 'cyberchimps_header_drag_drop_section',
    		'heading'  => 'cyberchimps_header_heading_one_page_business_pro'
    );
    
    
    

    
   /**************************** HEADER OPTIONS STARTS ***********************/
    
    
    
    $new_field[][8] = array(
    		'name'    => __( 'Custom Logo', 'cyberchimps_core' ),
    		'id'      => 'custom_logo',
    		'type'    => 'toggle',
    		'std'     => apply_filters( 'cyberchimps_logo_toggle', 0 ),
    		'section' => 'cyberchimps_header_options_section',
    		'heading' => 'cyberchimps_header_heading_one_page_business_pro'
    );
    
    $new_field[][9] = array(
    		'name'    => __( 'Logo Image', 'cyberchimps_core' ),
    		'desc'    => __( 'Enter URL or upload file', 'cyberchimps_core' ),
    		'id'      => 'custom_logo_uploader',
    		'class'   => 'custom_logo_toggle',
    		'type'    => 'upload',
    		'std'     => apply_filters( 'cyberchimps_default_logo', '/cyberchimps/lib/images/achimps.png' ),
    		'section' => 'cyberchimps_header_options_section',
    		'heading' => 'cyberchimps_header_heading_one_page_business_pro'
    );
    
   
    
    // Add Google Analytics only to pro themes. In free themes it will be added by plugin as per WP standards.
    $theme_check = cyberchimps_theme_check();
    if ( $theme_check == 'pro' ) {
    	$new_field[][14] = array(
    			'id'      => 'google_analytics',
    			'name'    => __( 'Google Analytics', 'cyberchimps_core' ),
    			'type'    => 'textarea',
    			'desc'    => __( 'Copy and paste your Google Analytics code here', 'cyberchimps_core' ),
    			'section' => 'cyberchimps_header_options_section',
    			'heading' => 'cyberchimps_header_heading_one_page_business_pro'
    	);
    }
    
  
    // Option to enter scripts into header.
    $theme_check = cyberchimps_theme_check();
    if ( $theme_check == 'pro' ) {
    	$new_field[][16] = array(
    			'id'      => 'header_scripts',
    			'name'    => __( 'Header Scripts', 'cyberchimps_core' ),
    			'type'    => 'unfiltered_textarea',
    			'desc'    => __( 'Please add script tags', 'cyberchimps_core' ),
    			'section' => 'cyberchimps_header_options_section',
    			'heading' => 'cyberchimps_header_heading_one_page_business_pro'
    	);
    }
 
 
 /* ******************** HEADER OPTIONS ENDS ********************** */
    
    
 /* *********************SERVICES SECTION START ************************ */
    
  // $new_field=[];
    $new_field[][1] = array(
            'name'    => __( 'Enable Section', 'cyberchimps_elements' ),
            'id'      => 'services_option',
            'type'    => 'toggle',
            'std'     => 'checked',
            'section' => 'cyberchimps_services_section_one_page_business_pro',
            'heading' => 'cyberchimps_sections_heading_one_page_business_pro'
    );
    
    $new_field[][2] = array(
            'name'    => __( 'Menu Title', 'cyberchimps_elements' ),
            'id'      => 'menu_title_services',
            'class'   => '',
            'std'     => apply_filters('max_width_default','Services'),
            'desc'    => __( 'Enter the title for section', 'cyberchimps_elements' ),
            'type'    => 'text',
            'section' => 'cyberchimps_services_section_one_page_business_pro',
            'heading' => 'cyberchimps_sections_heading_one_page_business_pro'
    );
    
    $new_field[][5] = array(
            'name'    => __( 'Services Title', 'cyberchimps_elements' ),
            'id'      => 'services_title',
            'class'   => '',
            'std'     => apply_filters('max_width_default','Services'),
            'desc'    => __( 'Enter the title for services section', 'cyberchimps_elements' ),
            'type'    => 'textarea',
            'section' => 'cyberchimps_services_section_one_page_business_pro',
            'heading' => 'cyberchimps_sections_heading_one_page_business_pro'
    );
    
    if ( $options_boxes_cats ) {
    	$new_field[][3] = array(
    			'name'    => __( 'Select Box Category', 'one-page-business-pro' ),
    			'id'      => 'services_category',
    			'type'    => 'select',
    			'options' => $options_boxes_cats,
    			'section' => 'cyberchimps_services_section_one_page_business_pro',
    			'heading' => 'cyberchimps_sections_heading_one_page_business_pro'
    	);
    }
    else {
    	$new_field[][4] = array(
    			'name'    => __( 'Select Box Category', 'one-page-business-pro' ),
    			'id'      => 'boxes_categories_help',
    			'type'    => 'help',
    			'desc'    => __( 'You need to create a Box Category', 'one-page-business-pro' ),
    			'section' => 'cyberchimps_services_section_one_page_business_pro',
    			'heading' => 'cyberchimps_sections_heading_one_page_business_pro'
    	);
    }
    
    
    
    $new_field[][6] = array(
            'name'    => __( 'Services Description', 'cyberchimps_elements' ),
            'id'      => 'services_desc',
            'std'     => '',
            'type'    => 'textarea',
            'desc'    => __( 'Enter the description for services section', 'cyberchimps_elements' ),
            'section' => 'cyberchimps_services_section_one_page_business_pro',
            'heading' => 'cyberchimps_sections_heading_one_page_business_pro'
    );
    

    
    /***************************Portfolio Section***************************/
   
    
    $options_boxes_cats = array();
    $boxes_terms        = get_terms( 'boxes_categories', 'hide_empty=0' );
    if ( !is_wp_error( $boxes_terms ) ):
    foreach ( $boxes_terms as $term ) {
    	$options_boxes_cats[$term->slug] = $term->name;
    }
    endif;
    
    
    
    $new_field[][1] = array(
            'name'    => __( 'Enable Section', 'cyberchimps_elements' ),
            'id'      => 'portfolio_option',
            'type'    => 'toggle',
            'std'     => 'checked',
            'section' => 'cyberchimps_portfolio_section_one_page_business_pro',
            'heading' => 'cyberchimps_sections_heading_one_page_business_pro'
    );
    
    $new_field[][2] = array(
            'name'    => __( 'Menu Title', 'cyberchimps_elements' ),
            'id'      => 'menu_title_portfolio',
            'class'   => '',
            'std'     => apply_filters('max_width_default','Portfolio'),
            'desc'    => __( 'Enter the top bar title for portfolio section', 'cyberchimps_elements' ),
            'type'    => 'text',
            'section' => 'cyberchimps_portfolio_section_one_page_business_pro',
            'heading' => 'cyberchimps_sections_heading_one_page_business_pro'
    );
        

        if ( $options_boxes_cats ) {
            $new_field[][6] = array(
                'name'    => __( 'Select Box Category', 'cyberchimps_core' ),
                'id'      => 'cyberchimps_blog_portfolio_pro_category',
                'type'    => 'select',
                'options' => $options_boxes_cats,
	            'section' => 'cyberchimps_portfolio_section_one_page_business_pro',
	            'heading' => 'cyberchimps_sections_heading_one_page_business_pro'
            );
        } else {
            $new_field[][7] = array(
                'name'    => __( 'Select Box Category', 'cyberchimps_core' ),
                'id'      => 'cyberchimps_blog_portfolio_pro_category_help',
                'type'    => 'help',
                'desc'    => __( 'You need to create a Box Category', 'cyberchimps_core' ),
            'section' => 'cyberchimps_portfolio_section_one_page_business_pro',
            'heading' => 'cyberchimps_sections_heading_one_page_business_pro'
            );
        }

        $new_field[][9] = array(
            'name'    => __( 'Portfolio Title', 'cyberchimps_core' ),
            'id'      => 'cyberchimps_blog_portfolio_pro_title_text',
            'class'   => '',
            'type'    => 'textarea',
        	'std'     => apply_filters('max_width_default','Portfolio'),
            'section' => 'cyberchimps_portfolio_section_one_page_business_pro',
            'heading' => 'cyberchimps_sections_heading_one_page_business_pro'
        );
    
     $new_field[][10] = array(
            'name'    => __( 'Portfolio Description', 'cyberchimps_elements' ),
            'id'      => 'portfolio_desc',
            'std'     => '',
            'type'    => 'textarea',
            'desc'    => __( 'Enter the description for portfolio section', 'cyberchimps_elements' ),
            'section' => 'cyberchimps_portfolio_section_one_page_business_pro',
            'heading' => 'cyberchimps_sections_heading_one_page_business_pro'
    );
    
    
    
    
    /*****************About Section *****************/
    
    $new_field[][1] = array(
            'name'    => __( 'Enable Section', 'cyberchimps_elements' ),
            'id'      => 'about_option',
            'type'    => 'toggle',
            'std'     => 'checked',
            'section' => 'cyberchimps_aboutus_section_one_page_business_pro',
            'heading' => 'cyberchimps_sections_heading_one_page_business_pro'
    );
    
    $new_field[][2] = array(
            'name'    => __( 'Menu Title', 'cyberchimps_elements' ),
            'id'      => 'menu_title_about',
            'class'   => '',
            'std'     => apply_filters('max_width_default','About'),
            'desc'    => __( 'Enter the title for section', 'cyberchimps_elements' ),
            'type'    => 'text',
            'section' => 'cyberchimps_aboutus_section_one_page_business_pro',
            'heading' => 'cyberchimps_sections_heading_one_page_business_pro'
    );
    
    $new_field[][3] = array(
            'name'    => __( 'About Title', 'cyberchimps_elements' ),
            'id'      => 'about_title',
            'class'   => '',
            'std'     => apply_filters('max_width_default','About'),
            'desc'    => __( 'Enter the title for about section', 'cyberchimps_elements' ),
            'type'    => 'textarea',
            'section' => 'cyberchimps_aboutus_section_one_page_business_pro',
            'heading' => 'cyberchimps_sections_heading_one_page_business_pro'
    );
    $new_field[][4] = array(
            'name'    => __( 'About Description', 'cyberchimps_elements' ),
            'id'      => 'about_desc',
            'std'     => '',
            'type'    => 'textarea',
            'desc'    => __( 'Enter the description for about section', 'cyberchimps_elements' ),
            'section' => 'cyberchimps_aboutus_section_one_page_business_pro',
            'heading' => 'cyberchimps_sections_heading_one_page_business_pro'
    );
      $new_field[][5] = array(
             'name' => __('Image', 'cyberchimps_elements' ),
             'desc' => __('Enter URL or upload file', 'cyberchimps_elements' ),
             'id' => 'about_image',             
             'type' => 'upload',
             'std'     => $directory_uri . apply_filters( 'cyberchimps_boxes_lite_img1', '/elements/lib/images/boxes/slidericon.png' ),             
			 'section' => 'cyberchimps_aboutus_section_one_page_business_pro',
             'heading' => 'cyberchimps_sections_heading_one_page_business_pro'
    );
     $new_field[][6] = array(
            'name'    => __( 'Side Description', 'cyberchimps_elements' ),
            'id'      => 'about_side_desc',
            'std'     => '',
            'type'    => 'textarea',
            'desc'    => __( 'Enter the side description for about section', 'cyberchimps_elements' ),
            'section' => 'cyberchimps_aboutus_section_one_page_business_pro',
            'heading' => 'cyberchimps_sections_heading_one_page_business_pro'
    );
    
  
    
    
     /*****************Team Section *****************/
    
    $new_field[][1] = array(
            'name'    => __( 'Enable Section', 'cyberchimps_elements' ),
            'id'      => 'team_option',
            'type'    => 'toggle',
            'std'     => 'checked',
            'section' => 'cyberchimps_team_section_one_page_business_pro',
            'heading' => 'cyberchimps_sections_heading_one_page_business_pro'
    );
    
    $new_field[][2] = array(
            'name'    => __( 'Menu Title', 'cyberchimps_elements' ),
            'id'      => 'menu_title_team',
            'class'   => '',
            'std'     => apply_filters('max_width_default','Team'),
            'desc'    => __( 'Enter the title for section', 'cyberchimps_elements' ),
            'type'    => 'text',
            'section' => 'cyberchimps_team_section_one_page_business_pro',
            'heading' => 'cyberchimps_sections_heading_one_page_business_pro'
    );
    
    if ( $options_boxes_cats ) {
    	$new_field[][3] = array(
    			'name'    => __( 'Select Box Category', 'cyberchimps_elements' ),
    			'id'      => 'team_category',
    			'type'    => 'select',
    			'options' => $options_boxes_cats,
    			'section' => 'cyberchimps_team_section_one_page_business_pro',
    			'heading' => 'cyberchimps_sections_heading_one_page_business_pro'
    	);
    }
    else {
    	$new_field[][4] = array(
    			'name'    => __( 'Select Box Category', 'cyberchimps_elements' ),
    			'id'      => 'boxes_categories_help',
    			'type'    => 'help',
    			'desc'    => __( 'You need to create a Box Category', 'cyberchimps_elements' ),
    			'section' => 'cyberchimps_team_section_one_page_business_pro',
    			'heading' => 'cyberchimps_sections_heading_one_page_business_pro'
    	);
    }
    
    $new_field[][5] = array(
            'name'    => __( 'Team Title', 'cyberchimps_elements' ),
            'id'      => 'team_title',
            'class'   => '',
            'std'     => apply_filters('max_width_default','Team'),
            'desc'    => __( 'Enter the title for team section', 'cyberchimps_elements' ),
            'type'    => 'textarea',
            'section' => 'cyberchimps_team_section_one_page_business_pro',
            'heading' => 'cyberchimps_sections_heading_one_page_business_pro'
    );
    $new_field[][6] = array(
            'name'    => __( 'Team Description', 'cyberchimps_elements' ),
            'id'      => 'team_desc',
            'std'     => '',
            'type'    => 'textarea',
            'desc'    => __( 'Enter the description for team section', 'cyberchimps_elements' ),
            'section' => 'cyberchimps_team_section_one_page_business_pro',
            'heading' => 'cyberchimps_sections_heading_one_page_business_pro'
    );
    
    

    
    
       /*****************Testimonial Section *****************/
    
    $new_field[][1] = array(
            'name'    => __( 'Enable Section', 'cyberchimps_elements' ),
            'id'      => 'testimonial_option',
            'type'    => 'toggle',
            'std'     => 'checked',
            'section' => 'cyberchimps_testimonial_section_one_page_business_pro',
            'heading' => 'cyberchimps_sections_heading_one_page_business_pro'
    );
    
    $new_field[][2] = array(
            'name'    => __( 'Menu Title', 'cyberchimps_elements' ),
            'id'      => 'menu_title_testimonial',
            'class'   => '',
            'std'     => apply_filters('max_width_default','Testimonial'),
            'desc'    => __( 'Enter the title for section', 'cyberchimps_elements' ),
            'type'    => 'text',
            'section' => 'cyberchimps_testimonial_section_one_page_business_pro',
            'heading' => 'cyberchimps_sections_heading_one_page_business_pro'
    );
    
    if ( $options_boxes_cats ) {
	    $new_field[][3] = array(
	        'name'    => __( 'Select Box Category', 'one-page-business-pro' ),
	        'id'      => 'testimonial_category',
	        'type'    => 'select',
	        'options' => $options_boxes_cats,
	        'section' => 'cyberchimps_testimonial_section_one_page_business_pro',
	        'heading' => 'cyberchimps_sections_heading_one_page_business_pro'
	    );
	}    
	else {
	        $new_field[][4] = array(
	            'name'    => __( 'Select Box Category', 'one-page-business-pro' ),
	            'id'      => 'boxes_categories_help',
	            'type'    => 'help',
	            'desc'    => __( 'You need to create a Box Category', 'one-page-business-pro' ),
	            'section' => 'cyberchimps_testimonial_section_one_page_business_pro',
	            'heading' => 'cyberchimps_sections_heading_one_page_business_pro'
	        );
	    }
	    $new_field[][5] = array(
	    		'name'    => __( 'Testimonial Title', 'cyberchimps_elements' ),
	    		'id'      => 'testimonial_title',
	    		'class'   => '',
	    		'std'     => apply_filters('max_width_default','Testimonial'),
	    		'desc'    => __( 'Enter the title for testimonial section', 'cyberchimps_elements' ),
	    		'type'    => 'textarea',
	    		'section' => 'cyberchimps_testimonial_section_one_page_business_pro',
	    		'heading' => 'cyberchimps_sections_heading_one_page_business_pro'
	    );
    
   /******************************** Contact Section *********************************/
    
    $new_field[][1] = array(
            'name'    => __( 'Enable Section', 'cyberchimps_elements' ),
            'id'      => 'contact_option',
            'type'    => 'toggle',
            'std'     => 'checked',
            'section' => 'cyberchimps_contact_section_one_page_business_pro',
            'heading' => 'cyberchimps_sections_heading_one_page_business_pro'
    );
    $new_field[][2] = array(
            'name'    => __( 'Menu Title', 'cyberchimps_elements' ),
            'id'      => 'menu_title_contact',
            'class'   => '',
            'std'     => apply_filters('max_width_default','Contact'),
            'desc'    => __( 'Enter the title for section', 'cyberchimps_elements' ),
            'type'    => 'text',
            'section' => 'cyberchimps_contact_section_one_page_business_pro',
            'heading' => 'cyberchimps_sections_heading_one_page_business_pro'
    );
    
    $new_field[][3] = array(
            'name'    => __( 'Contact Title', 'cyberchimps_elements' ),
            'id'      => 'contact_title',
            'class'   => '',
            'std'     => apply_filters('max_width_default','Contact'),
            'desc'    => __( 'Enter the title for contact section', 'cyberchimps_elements' ),
            'type'    => 'textarea',
            'section' => 'cyberchimps_contact_section_one_page_business_pro',
            'heading' => 'cyberchimps_sections_heading_one_page_business_pro'
    );
    $new_field[][4] = array(
            'name'    => __( 'Contact Description', 'cyberchimps_elements' ),
            'id'      => 'contact_desc',
            'std'     => '',
            'type'    => 'textarea',
            'desc'    => __( 'Enter the contact description', 'cyberchimps_elements' ),
            'section' => 'cyberchimps_contact_section_one_page_business_pro',
            'heading' => 'cyberchimps_sections_heading_one_page_business_pro'
    );
    
      $new_field[][5] = array(
            'name'    => __( 'Contact Address', 'cyberchimps_elements' ),
            'id'      => 'contact_address',
            'std'     => '',
            'type'    => 'textarea',
            'desc'    => __( 'Enter the contact description', 'cyberchimps_elements' ),
            'section' => 'cyberchimps_contact_section_one_page_business_pro',
            'heading' => 'cyberchimps_sections_heading_one_page_business_pro'
    );
    
    
      $new_field[][6] = array(
            'name'    => __( 'Email Address', 'cyberchimps_elements' ),
            'id'      => 'contact_email',
            'std'     => '',
            'type'    => 'text',
            'desc'    => __( 'Enter the Email', 'cyberchimps_elements' ),
            'section' => 'cyberchimps_contact_section_one_page_business_pro',
            'heading' => 'cyberchimps_sections_heading_one_page_business_pro'
    );
    
    
      $new_field[][7] = array(
            'name'    => __( 'Phone Number', 'cyberchimps_elements' ),
            'id'      => 'contact_phone',
            'std'     => '',
            'type'    => 'text',
            'desc'    => __( 'Enter the Phone number', 'cyberchimps_elements' ),
            'section' => 'cyberchimps_contact_section_one_page_business_pro',
            'heading' => 'cyberchimps_sections_heading_one_page_business_pro'
    );
      
      $new_field[][8] = array(
      		'name'    => __( 'Facebook', 'cyberchimps_elements' ),
      		'id'      => 'contact_facebook',
      		'std'     => '',
      		'type'    => 'text',
      		'desc'    => __( 'Enter the Facebook URL', 'cyberchimps_elements' ),
      		'section' => 'cyberchimps_contact_section_one_page_business_pro',
      		'heading' => 'cyberchimps_sections_heading_one_page_business_pro'
      );
      $new_field[][9] = array(
      		'name'    => __( 'Twitter', 'cyberchimps_elements' ),
      		'id'      => 'contact_twitter',
      		'std'     => '',
      		'type'    => 'text',
      		'desc'    => __( 'Enter the Twiiter URL', 'cyberchimps_elements' ),
      		'section' => 'cyberchimps_contact_section_one_page_business_pro',
      		'heading' => 'cyberchimps_sections_heading_one_page_business_pro'
      );
      $new_field[][10] = array(
      		'name'    => __( 'Dribbble', 'cyberchimps_elements' ),
      		'id'      => 'contact_dribbble',
      		'std'     => '',
      		'type'    => 'text',
      		'desc'    => __( 'Enter the Dribble URL', 'cyberchimps_elements' ),
      		'section' => 'cyberchimps_contact_section_one_page_business_pro',
      		'heading' => 'cyberchimps_sections_heading_one_page_business_pro'
      );
      $new_field[][11] = array(
      		'name'    => __( 'Github', 'cyberchimps_elements' ),
      		'id'      => 'contact_github',
      		'std'     => '',
      		'type'    => 'text',
      		'desc'    => __( 'Enter the Github URL', 'cyberchimps_elements' ),
      		'section' => 'cyberchimps_contact_section_one_page_business_pro',
      		'heading' => 'cyberchimps_sections_heading_one_page_business_pro'
      );
      $new_field[][12] = array(
      		'name'    => __( 'Instagram', 'cyberchimps_elements' ),
      		'id'      => 'contact_instagram',
      		'std'     => '',
      		'type'    => 'text',
      		'desc'    => __( 'Enter the Instagram URL', 'cyberchimps_elements' ),
      		'section' => 'cyberchimps_contact_section_one_page_business_pro',
      		'heading' => 'cyberchimps_sections_heading_one_page_business_pro'
      );
    
      $new_field[][13] = array(
      		'name'    => __( 'Linkedin', 'cyberchimps_elements' ),
      		'id'      => 'contact_linkedin',
      		'std'     => '',
      		'type'    => 'text',
      		'desc'    => __( 'Enter the Linkedin URL', 'cyberchimps_elements' ),
      		'section' => 'cyberchimps_contact_section_one_page_business_pro',
      		'heading' => 'cyberchimps_sections_heading_one_page_business_pro'
      );
      
      // Remove footer widgets toggle from theme options  
    $elements = count($original);
    for( $i = 0; $i < $elements; $i++ )
    {
        if( array_key_exists('id', $original[$i]) )
        {
            if( $original[$i]['id'] == 'footer_show_toggle' )
            {
                   unset( $original[$i] );
            }
        }
    }



      $new_fields = cyberchimps_array_field_organizer( $original, apply_filters( 'cyberchimps_pro_header_fields', $new_field ) );

    return $new_fields;
}

add_filter( 'cyberchimps_field_filter', 'one_page_business_pro_add_fields', 1 );

//add header drag and drop options
function one_page_business_pro_add_header_drag_and_drop_options() {
	$options = array(

			'cyberchimps_logo'              => __( 'Logo', 'cyberchimps_elements' )
	);

	return $options;
}

add_filter( 'header_drag_and_drop_options', 'one_page_business_pro_add_header_drag_and_drop_options', 50 );


function one_page_business_pro_remove_box_elements(){
remove_meta_box( 'boxes','boxes', 'normal' );
remove_meta_box( 'cyberchimps_page_options','page', 'normal' );
remove_meta_box( 'callout_section_options','page', 'normal' );
remove_meta_box( 'carousel_section_options','page', 'normal' );
remove_meta_box( 'html_box_options','page', 'normal' );
remove_meta_box( 'magazine_options','page', 'normal' );
remove_meta_box( 'portfolio_pro_options','page', 'normal' );
remove_meta_box( 'product_element_options','page', 'normal' );
remove_meta_box( 'page_slider_options','page', 'normal' );
remove_meta_box( 'twitterbar_section_options','page', 'normal' );
remove_meta_box( 'boxes_options','page', 'normal' );
remove_meta_box( 'recent_posts_options','page', 'normal' );
remove_meta_box( 'separator_options','page', 'normal' );
remove_meta_box( 'blank_space_options','page', 'normal' );
remove_meta_box( 'google_maps_options','page', 'normal' );
remove_meta_box( 'video_options','page', 'normal' );
remove_meta_box( 'post_slider_options','post', 'normal' );
remove_meta_box( 'showcase_options','page', 'normal' );
}
add_action('do_meta_boxes','one_page_business_pro_remove_box_elements');

function one_page_business_pro_remove_element_items()
{
	remove_menu_page( 'edit.php?post_type=portfolio_images' );
	remove_menu_page( 'edit.php?post_type=custom_slides' );
	remove_menu_page( 'edit.php?post_type=featured_posts' );
	remove_menu_page( 'edit.php?post_type=showcase_posts' );
	remove_menu_page( 'edit.php?post_type=testimonial_posts' );
}
add_action( 'admin_menu', 'one_page_business_pro_remove_element_items' );

function one_page_business_pro_customize_register( $wp_customize )
{
	$wp_customize->remove_section( 'cyberchimps_layout_section' );
	$wp_customize->remove_section( 'cyberchimps_blog_section' );
    	$wp_customize->remove_panel( 'template_id' );
	$wp_customize->remove_control('menu_active_text_colorpicker');
  	$wp_customize->remove_control('footer_show_toggle');
	$wp_customize->remove_control('blogdescription');
   	$wp_customize->remove_control('searchbar');
    	$wp_customize->remove_control('sticky_header');
	$wp_customize->remove_control('font_family_h1_size');
	$wp_customize->remove_control('font_family_h2_size');
	$wp_customize->remove_control('font_family_h3_size');
	$wp_customize->remove_control('font_family_h1_face');
	$wp_customize->remove_control('font_family_h2_face');
	$wp_customize->remove_control('font_family_h3_face');
	$wp_customize->remove_control('google_font_h2');
	$wp_customize->remove_control('google_font_h1');
	$wp_customize->remove_control('google_font_h3');
	$wp_customize->remove_section('cyberchimps_social_media');
	$wp_customize->remove_section( 'static_front_page' );
}
add_action( 'customize_register', 'one_page_business_pro_customize_register',20 );


/* To remove 'Menus' panel from customizer  */
								//remove_panel would cause warnings
function wpdocs_remove_nav_menus_panel( $components ) {
    $i = array_search( 'nav_menus', $components );
    if ( false !== $i ) {
        unset( $components[ $i ] );
    }
    return $components;
}
add_filter( 'customize_loaded_components', 'wpdocs_remove_nav_menus_panel' );

/*=================*/


function one_page_business_pro_portfolio_render_display() { 
global $post; 

if( !get_option('cyberchimps_options') )
        {
		$portfolio_desc = "Description of your portfolio";
	}
	else
	{
		$res = get_option('cyberchimps_options');
		$portfolio_desc = (isset($res['portfolio_desc'])) ? cyberchimps_get_option('portfolio_desc') : "Description of your portfolio" ;
	}

?>
    
<!-- Portfolio Section -->
<div id="works-section" class="text-center">
  <div class="container"> <!-- Container -->
    <div class="section-title wow fadeInDown">
      <h2><?php 
    if(cyberchimps_get_option('cyberchimps_blog_portfolio_pro_title_text'))
    {
      echo _e(cyberchimps_get_option('cyberchimps_blog_portfolio_pro_title_text'));
    }
    else 
        echo _e("Portfolio");
      ?>
      </h2>
      <hr>
      <div class="clearfix"></div>
      <p><?php 
      
        echo _e($portfolio_desc); 
      
      ?></p>
    </div>
     <div class="row">
      <div class="portfolio-items">
       
<?php 
    $box_counter    = 1;
    $box_id_counter = 1;
    $template_directory = get_template_directory_uri();
    $customcategory_portfolio = cyberchimps_get_option( 'cyberchimps_blog_portfolio_pro_category', '' );
    
// Custom box query
    $args  = array(
        'numberposts'      => -1,
        'offset'           => 0,
        'boxes_categories' => $customcategory_portfolio,
        'orderby'          => 'post_date',
        'order'            => 'ASC',
        'post_type'        => 'boxes',
        'post_status'      => 'publish',
        'suppress_filters' => false
    );
    $boxes = get_posts( $args );
    $count = count( $boxes );
    if( $count ==4 || $count > 4 )
    {
        $len = " col-sm-6 col-md-3 col-lg-3 web ";
    }
    else if( $count == 3 )
     {
        $len = " col-sm-6 col-md-3 col-md-offset-1 col-lg-3 col-lg-offset-1 web ";  
     }
     else if( $count == 2 )
     {
        $len = " col-sm-6 col-md-3 col-md-offset-2 col-lg-3 col-lg-offset-2 web ";  
     }
     else if( $count == 1 )
     {
        $len = " col-sm-12 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4 web ";  
     }
     else
     {
        $len = " col-sm-6 col-md-4 col-md-offset-4 col-lg-4 col-lg-offset-4 web ";  
     }   
      if( $boxes && $customcategory_portfolio != '' ){
        foreach( $boxes as $box ){
                $box_title = ! empty( $box->post_title ) ? $box->post_title : '';
                $box_image = get_post_meta( $box->ID, 'portfolio_cyberchimps_box_image', true );
                $box_text = get_post_meta( $box->ID, 'portfolio_cyberchimps_box_short_description', true );
                $box_des_long = get_post_meta( $box->ID, 'portfolio_cyberchimps_box_description', true ); ?>
                    
       <div class="<?php echo $len; ?> portfolio_box">
           <div class="portfolio-item wow fadeInUp" data-wow-delay="200ms">
            <div class="hover-bg"> <a href="#portfolioModal<?php echo $box_counter; ?>" class="portfolio-link" data-toggle="modal">
              <div class="hover-text">
                <h4><?php echo $box_title; ?></h4>
                
                <div class="clearfix"></div>
                <i class="fa fa-plus"></i> </div>
              <img class="img-responsive img-centered" src="<?php echo $box_image; ?>"  alt="<?php echo $box_title; ?>"> </a> </div>
          </div>
        </div>
      
      <?php 
      $box_counter++; 
      $box_id_counter++; 
      } 
     }?>
  
     </div>
    </div>
  </div>
</div>

<?php 
    $box_counter    = 1;
    $box_id_counter = 1;
    $template_directory = get_template_directory_uri();
    $customcategory_portfolio = cyberchimps_get_option( 'cyberchimps_blog_portfolio_pro_category', '' );
    
// Custom box query
    $args  = array(
        'numberposts'      => -1,
        'offset'           => 0,
        'boxes_categories' => $customcategory_portfolio,
        'orderby'          => 'post_date',
        'order'            => 'ASC',
        'post_type'        => 'boxes',
        'post_status'      => 'publish',
        'suppress_filters' => false
    );
    $boxes = get_posts( $args );
    
      if( $boxes && $customcategory_portfolio != '' ){
        foreach( $boxes as $box ){
                $box_title = ! empty( $box->post_title ) ? $box->post_title : '';
                $box_image = get_post_meta( $box->ID, 'portfolio_cyberchimps_box_image', true );
                $box_text = get_post_meta( $box->ID, 'portfolio_cyberchimps_box_short_description', true );
                $box_des_long = get_post_meta( $box->ID, 'portfolio_cyberchimps_box_description', true ); ?>

<!-- Portfolio Modal 1 -->
<div class="portfolio-modal modal fade" id="portfolioModal<?php echo $box_counter;?>" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-content">
    <div class="close-modal" data-dismiss="modal">
      <div class="lr">
        <div class="rl"> </div>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
          <div class="modal-body"> 
            <!-- Project Details Go Here -->
            <h2><?php echo $box_title; ?></h2>
            <p class="item-intro"><?php echo $box_text;?></p>
            <img class="img-responsive img-centered" src="<?php echo $box_image; ?>" alt="<?php echo $box_title; ?>">
            <p><?php echo $box_des_long ;?></p>

            <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close Project</button>
          </div>
        </div>
      </div>
    </div>
  </div>
 </div>

  <?php 
      $box_counter++; 
      $box_id_counter++; 
      } 
     } 
}
     
     
function one_page_business_pro_team_boxes_render_display() {

if( !get_option('cyberchimps_options') )
        {
		$team_desc = "Description of your team";
	}
	else
	{
		$res = get_option('cyberchimps_options');
		$team_desc = (isset($res['team_desc'])) ? cyberchimps_get_option('team_desc') : "Description of your team. This is a sample paragraph." ;
	}


 ?>
<div id="team-section" class="text-center">
  <div class="container">
    <div class="section-title wow fadeInDown">
      <h2><?php 
      if(cyberchimps_get_option('team_title'))
        echo _e(cyberchimps_get_option('team_title'));
      else
        echo _e("Team");
      ?></h2>
      <hr>
      <div class="clearfix"></div>      
      <p><?php 
      
          echo _e($team_desc);
      
      ?></p>
    </div>
    <div id="row">
   
   <?php 	

	// Intialize box counter
	$box_counter    = 1;
	$box_id_counter = 1;

	// Set template directory uri
	$template_directory = get_template_directory_uri();

	// Get options for boxes.
	
    $customcategory = cyberchimps_get_option( 'team_category', '' );
	
   // Custom box query
	$args  = array(
		'numberposts'      => -1,
		'offset'           => 0,
		'boxes_categories' => $customcategory,
		'orderby'          => 'post_date',
		'order'            => 'ASC',
		'post_type'        => 'boxes',
		'post_status'      => 'publish',
		'suppress_filters' => false
	);
	$boxes = get_posts( $args );
	$count = count( $boxes );
    if( $count ==4 || $count > 4 )
    {
        $len = " col-sm-6 col-md-3 col-lg-3 team wow fadeInUp ";
    }
    else if( $count == 3 )
     {
        $len = " col-sm-6 col-md-3 col-md-offset-1 col-lg-3 col-lg-offset-1 team wow fadeInUp ";  
     }
     else if( $count == 2 )
     {
        $len = " col-sm-6 col-md-3 col-md-offset-2 col-lg-3 col-lg-offset-2 team wow fadeInUp ";  
     }
     else
     {
        $len = " col-sm-6 col-md-4 col-md-offset-4 col-lg-4 col-lg-offset-4 team wow fadeInUp ";  
     }
			if( $boxes && $customcategory != '' ):
				foreach( $boxes as $box ):
					
					// Get the title of the box
					$box_title = ! empty( $box->post_title ) ? $box->post_title : '';

					// Get the image of the box
					$box_image = get_post_meta( $box->ID, 'team_cyberchimps_box_image', true );

					// Get the text of the box
					$box_text = get_post_meta( $box->ID, 'team_cyberchimps_box_description', true );
					
					$facebook=get_post_meta( $box->ID, 'team_cyberchimps_box_facebook_url', true );
					$twitter=get_post_meta( $box->ID, 'team_cyberchimps_box_twitter_url', true );
					$google=get_post_meta( $box->ID, 'team_cyberchimps_box_google_url', true );
					
					// Get the Read more text ?>
  <div class="<?php  echo $len; ?> team_box" data-wow-delay="200ms">
 <?php if(get_post_meta( $box->ID, 'team_cyberchimps_box_image', true ))
	    {
		?><div class="thumbnail"> <img class="img-circle img-center team-img img-responsive " src="<?php echo $box_image; ?>" alt="..." >
      <?php }	
      ?>
        
          <div class="caption">
            <h3><strong><?php echo $box_title; ?></strong></h3>
            <?php echo $box_text; ?>
            <ul class="list-inline">
              <?php if($facebook) {?><li><a href="<?php echo $facebook; ?>" target="_blank"><i class="fa fa-facebook"></i></a></li><?php }?>
              <?php if($twitter) {?><li><a href="<?php echo $twitter; ?>" target="_blank"><i class="fa fa-twitter"></i></a></li><?php }?>
              <?php if($google) {?><li><a href="<?php echo $google; ?>" target="_blank"><i class="fa fa-google-plus"></i></a></li><?php }?>
            </ul>
         </div>
      </div>
    </div>
               <?php 
					$box_counter++;
					$box_id_counter++;
				endforeach;
				endif;?>
				
    </div>
  </div>
</div><?php } 
function one_page_business_pro_services_boxes_render_display() {

if( !get_option('cyberchimps_options') )
        {
		$services_desc = "Description of your services";
	}
	else
	{
		$res = get_option('cyberchimps_options');
		$services_desc = (isset($res['services_desc'])) ? cyberchimps_get_option('services_desc') : "Description of your services" ;
	}


?> 
<div id="services-section" class="text-center">
  <div class="container">
    <div class="section-title wow fadeInDown">
      <h2><?php 
      if(cyberchimps_get_option('services_title'))
      {
          echo _e(cyberchimps_get_option('services_title'));
      }
      else 
            echo _e("Services");
       ?></h2>
      <hr>
      <div class="clearfix"></div>
      <p><?php 
        
      echo _e($services_desc); 
   
      ?></p>
    
    </div>
    <div class="space"></div>
    <div class="row">
      
      	<?php 	
    // Intialize box counter
	$box_counter    = 1;
	$box_id_counter = 1;

	// Set template directory uri
	$template_directory = get_template_directory_uri();

	// Get options for boxes.
	
	$customcategory_services = cyberchimps_get_option( 'services_category', '' );
	
	// Custom box query
	$args  = array(
		'numberposts'      => -1,
		'offset'           => 0,
		'boxes_categories' => $customcategory_services,
		'orderby'          => 'post_date',
		'order'            => 'ASC',
		'post_type'        => 'boxes',
		'post_status'      => 'publish',
		'suppress_filters' => false
	);
	     
	         $boxes = get_posts( $args );
             $count = count( $boxes );
                if( $count ==4 || $count > 4 )
                {
                    $len = " col-sm-6 col-md-3 col-lg-3 service wow fadeInUp ";
                }
                else if( $count == 3 )
                 {
                    $len = " col-sm-6 col-md-3 col-md-offset-1 col-lg-3 col-lg-offset-1 service wow fadeInUp ";  
                 }
                 else if( $count == 2 )
                 {
                    $len = " col-sm-6 col-md-3 col-md-offset-2 col-lg-3 col-lg-offset-2 service wow fadeInUp ";  
                 }
                 else
                 {
                    $len = " col-sm-6 col-md-4 col-md-offset-4 col-lg-4 col-lg-offset-4 service wow fadeInUp ";  
                 }
	         if( $boxes && $customcategory_services != '' ):
                
				foreach( $boxes as $box ):
              // Get the title of the box
					$box_title = ! empty( $box->post_title ) ? $box->post_title : '';

					// Get the image of the box
					$box_image = get_post_meta( $box->ID, 'service_cyberchimps_box_image', true );

					// Get the text of the box
					$box_text = get_post_meta( $box->ID, 'service_cyberchimps_box_description', true );
					
					// Get the Read more text
					?>
      <?php if(get_post_meta( $box->ID, 'service_cyberchimps_box_image', true ))
	    {
		?><div class="<?php echo $len; ?>" data-wow-delay="800ms"><img class="img-centered img-responsive" src="<?php echo $box_image;?>" alt="<?php echo $box_title; ?>">
      <?php }	
      ?>

        <h4><strong><?php echo $box_title; ?></strong></h4>
        <p><?php echo $box_text; ?></p>
      </div>
      
       <?php 
         $box_counter++;
		 $box_id_counter++; 
         endforeach; endif; ?>
    </div>
  </div>
</div>
<?php }

function one_page_business_pro_testimonial_boxes_render_display(){ 
$template_directory = get_template_directory_uri();?>
<div id="testimonials-section" class="text-center" style="background-image:url(<?php echo $template_directory;?>/img/testimonials-bg.jpg);">
  <div class="container">
    <div class="section-title wow fadeInDown">
      <h2><?php 
      if(cyberchimps_get_option('testimonial_title'))
          echo _e(cyberchimps_get_option('testimonial_title'));
      else
            echo _e("Testimonial");
      ?></h2>
      <hr>
    </div>
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div id="testimonial" class="owl-carousel owl-theme wow fadeInUp" data-wow-delay="200ms">
      <?php 
       // Intialize box counter
	$box_counter    = 1;
	$box_id_counter = 1;

	// Set template directory uri
	$template_directory = get_template_directory_uri();

	// Get options for boxes.
	
	$customcategory_testimonial = cyberchimps_get_option( 'testimonial_category', '' );
	
	
  // Custom box query
	$args  = array(
		'numberposts'      => -1,
		'offset'           => 0,
		'boxes_categories' => $customcategory_testimonial,
		'orderby'          => 'post_date',
		'order'            => 'ASC',
		'post_type'        => 'boxes',
		'post_status'      => 'publish',
		'suppress_filters' => false
	);
	     $boxes = get_posts( $args );
	     if( $boxes && $customcategory_testimonial != '' ):
	     foreach( $boxes as $box ):
					
					// Get the title of the box
					$box_title = ! empty( $box->post_title ) ? $box->post_title : '';

					// Get the text of the box
					$box_text = get_post_meta( $box->ID, 'testimonial_cyberchimps_box_description', true );
					
					// Get the Read more text ?>
         
          <div class="item">
            <p><?php echo $box_title;?></p>
            <?php echo $box_text;?>


          </div>
        
         <?php 
         $box_counter++;
		 $box_id_counter++; ?>
            <?php endforeach; endif; ?>
        </div>
      </div>
    </div>
  </div>
</div>
<?php }

add_action('wp_head','wp_ajax_url');
function wp_ajax_url(){
	if(!is_admin())
	{?>
		<script type="text/javascript">
		var ajax_url = '<?php echo admin_url('admin-ajax.php'); ?>';
		</script>
	<?php 	
	}
}

add_action('wp_ajax_nopriv_ajax_contact_mail','ajax_contact_mail');
add_action('wp_ajax_ajax_contact_mail','ajax_contact_mail');
function ajax_contact_mail()
{
     
    $un=$_POST['username'];
    $em=$_POST['useremail'];
    $msg=$_POST['mesg'];
    
    $admin_mail= get_option('admin_email');
    
   $sub = "Website Contact Form:  $un";
    $headers = 'From: '.$un.' '.'<'.$em.'>'. "\r\n";
    if(wp_mail($admin_mail, $sub, $msg,$headers)){
        echo $result="mail_sent";
    } else {
        echo $result="mail_error";
    }
}



//add typography sizes to customizer
function one_page_business_pro_typography_sizes()
{
	$style=array( '8', '10', '12', '14', '16', '20' );
	return $style;
}
add_filter( 'cyberchimps_typography_sizes', 'one_page_business_pro_typography_sizes' );



add_filter('cyberchimps_heading1_typography_defaults', 'one_page_business_pro_typography_h1');
function one_page_business_pro_typography_h1()
{
$default = array(
'size' => '36px',
'face' => '"Open Sans Condensed", sans-serif',
'style' => '',
'color' => '',
);

return $default;
}


add_filter( 'cyberchimps_typography_defaults', 'one_page_business_pro_typography_defaults' );
function one_page_business_pro_typography_defaults() {
$default = array(
'size' => '14px',
'face' => '"Open Sans Condensed", sans-serif',
'style' => 'normal',
'color' => ''
);

return $default;
}


/* To remove Menus option from Appearance */
add_action( 'admin_menu', 'one_page_business_pro_adjust_the_wp_menu', 999 );
function one_page_business_pro_adjust_the_wp_menu() 
{
  remove_submenu_page( 'themes.php', 'nav-menus.php' );
}



	?>
