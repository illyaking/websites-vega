<?php
/**
 * Element Initializer
 *
 * Please do not edit this file. This file is part of the CyberChimps Framework and all modifications
 * should be made in a child theme.
 *
 * @category CyberChimps Framework
 * @package  Framework
 * @since    1.0
 * @author   CyberChimps
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v3.0 (or later)
 * @link     http://www.cyberchimps.com/
 */

// Load style for elements
function cyberchimps_add_elements_scripts() {

	// Set path of library
	$path_lib = get_template_directory_uri() . '/elements/lib/';

	// Add JS for elastislide library to be used for carousel element.
	wp_register_script( 'elastislide', $path_lib . 'js/jquery.elastislide.min.js', array( 'jquery' ), 1, true );
	wp_enqueue_script( 'elastislide' );

	wp_register_style( 'elements_style', $path_lib . 'css/elements.css' );
	wp_enqueue_style( 'elements_style' );

	wp_register_style( 'jcarousel-skin', $path_lib . 'css/jcarousel/skin.css' );
	wp_enqueue_style( 'jcarousel-skin', array( 'bootstrap-responsive-style', 'bootstrap-style' ), '1.0' );

	wp_register_script( 'elements_js', $path_lib . 'js/elements.min.js', array( 'jquery' ), '2013.12.12', true );
	wp_enqueue_script( 'elements_js' );
}

add_action( 'wp_enqueue_scripts', 'cyberchimps_add_elements_scripts', 19 );

// Set path of element folder.
$path_elements = get_template_directory() . '/elements/';

// Load elements
require_once( $path_elements . 'widgets.php' );
require_once( $path_elements . 'breadcrumbs.php' );
require_once( $path_elements . 'callout.php' );
require_once( $path_elements . 'carousel.php' );
require_once( $path_elements . 'htmlbox.php' );
require_once( $path_elements . 'magazine.php' );
require_once( $path_elements . 'pagination.php' );
require_once( $path_elements . 'portfolio.php' );
require_once( $path_elements . 'product.php' );
require_once( $path_elements . 'slider.php' );
require_once( $path_elements . 'twitter-bar.php' );
require_once( $path_elements . 'recent-posts.php' );
require_once( $path_elements . 'boxes.php' );
require_once( $path_elements . 'parallax.php' );
require_once( $path_elements . 'dashboard-widget.php' );
require_once( $path_elements . 'separator.php' );
require_once( $path_elements . 'blank-space.php' );
require_once( $path_elements . 'google-maps.php' );
require_once( $path_elements . 'video.php' );
require_once( $path_elements . 'showcase.php' );
require_once( $path_elements . 'testimonial.php' );
//require_once( $path_elements . 'profile.php' );
//require_once( $path_elements . 'featured-posts.php' );

// Load shortcodes
require_once( $path_elements . 'shortcodes/init.php' );

function cyberchimps_selected_elements() {
	$options = array(
		'boxes'              => __( 'Boxes', 'cyberchimps_elements' ),
		"callout_section"    => __( 'Callout Section', 'cyberchimps_elements' ),
		"carousel_section"   => __( 'Carousel', 'cyberchimps_elements' ),
		//'featured_posts'		=> __( 'Featured Posts', 'cyberchimps_elements' ),
		'html_box'           => __( 'HTML Box', 'cyberchimps_elements' ),
		'page_slider'        => __( 'CyberChimps Slider', 'cyberchimps_elements' ),
		'magazine'				=> __( 'Magazine', 'cyberchimps_elements' ),
		'portfolio_pro'      => __( 'Portfolio', 'cyberchimps_elements' ),
		"blog_post_page"     => __( 'Post Page', 'cyberchimps_elements' ),
		"product_element"    => __( 'Product', 'cyberchimps_elements' ),
		//"profile"				=> __( 'Profile', 'cyberchimps_elements' ),
		'recent_posts'       => __( 'Recent Posts', 'cyberchimps_elements' ),
		"twitterbar_section" => __( 'Twitter Bar', 'cyberchimps_elements' ),
		"widgets_section"    => __( 'Widgets', 'cyberchimps_elements' ),
		"separator"	     => __( 'Separator', 'cyberchimps_elements'),
		"blank_space"	     => __( 'Blank Space', 'cyberchimps_elements'),
		"google_maps"	     => __( 'Google Maps', 'cyberchimps_elements'),
		"video"	     => __( 'Video', 'cyberchimps_elements'),
		"showcase"	     => __( 'Showcase', 'cyberchimps_elements'),
		"testimonial"	     => __( 'Testimonial', 'cyberchimps_elements')
	);

	return $options;
}

add_filter( 'cyberchimps_elements_draganddrop_options', 'cyberchimps_selected_elements', 2 );

//set defaults elements for page draga and drop
function cyberchimps_selected_page_elements() {
	$options = array(
		'boxes'              => __( 'Boxes', 'cyberchimps_elements' ),
		'breadcrumbs'        => __( 'Breadcrumbs', 'cyberchimps_elements' ),
		"callout_section"    => __( 'Callout Section', 'cyberchimps_elements' ),
		"carousel_section"   => __( 'Carousel', 'cyberchimps_elements' ),
		//'featured_posts'		=> __( 'Featured Posts', 'cyberchimps_elements' ),
		'html_box'           => __( 'HTML Box', 'cyberchimps_elements' ),
		'page_slider'        => __( 'CyberChimps Slider', 'cyberchimps_elements' ),
		'magazine'				=> __( 'Magazine', 'cyberchimps_elements' ),
		'portfolio_pro'      => __( 'Portfolio', 'cyberchimps_elements' ),
		"page_section"       => __( 'Page', 'cyberchimps_elements' ),
		"product_element"    => __( 'Product', 'cyberchimps_elements' ),
		//"profile"				=> __( 'Profile', 'cyberchimps_elements' ),
		'recent_posts'       => __( 'Recent Posts', 'cyberchimps_elements' ),
		"twitterbar_section" => __( 'Twitter Bar', 'cyberchimps_elements' ),
		"widgets_section"    => __( 'Widgets', 'cyberchimps_elements' ),
		"separator"	     => __( 'Separator', 'cyberchimps_elements'),
		"blank_space"	     => __( 'Blank Space', 'cyberchimps_elements'),
		"google_maps"	     => __( 'Google Maps', 'cyberchimps_elements'),
		"video"		=> __( 'Video', 'cyberchimps_elements'),
		"showcase"	     => __( 'Showcase', 'cyberchimps_elements'),
		"testimonial"	     => __( 'Testimonial', 'cyberchimps_elements')
	);

	return $options;
}

add_filter( 'cyberchimps_elements_draganddrop_page_options', 'cyberchimps_selected_page_elements', 2 );

/**  
 *	============ Moved from core/options-medialibrary-uploader.php ===========
 *	============= as register_post_type() is plugin-territory ================
 * Sets up a custom post type to attach image to. This allows us to have
 * individual galleries for different uploaders.
 */
if( !function_exists( 'cyberchimps_mlu_init' ) ) {
	function cyberchimps_mlu_init() {
		register_post_type( 'cybrchmpsthmoption', array(
			'labels'            => array(
				'name' => __( 'Theme Options Media', 'cyberchimps_elements' ),
			),
			'public'            => true,
			'show_ui'           => false,
			'capability_type'   => 'post',
			'hierarchical'      => false,
			'rewrite'           => false,
			'supports'          => array( 'title', 'editor' ),
			'query_var'         => false,
			'can_export'        => true,
			'show_in_nav_menus' => false,
			'public'            => false
		) );
	}
}
add_action( 'admin_init', 'cyberchimps_mlu_init' );
/**
 * Include the TGM_Plugin_Activation class.
 */
require_once dirname( __FILE__ ) . '/includes/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'my_theme_register_required_plugins' );

function my_theme_register_required_plugins() {

	$plugins = array(

		array(
			'name'               => 'SlideDeck3', // The plugin name.
			'slug'               => 'slidedeck3-personal', // The plugin slug (typically the folder name).
			'source'             => get_stylesheet_directory() . '/elements/lib/plugins/slidedeck3-personal.zip', // The plugin source.
			'required'           => false, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			'external_url'       => '', // If set, overrides default API URL and points to an external URL.
			'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
		),
	);

	$config = array(
		'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.

		
		'strings'      => array(
			'page_title'                      => __( 'Install Required Plugins', 'cyberchimps_elements' ),
			'menu_title'                      => __( 'Install Plugins', 'cyberchimps_elements' ),
			'installing'                      => __( 'Installing Plugin: %s', 'cyberchimps_elements' ), // %s = plugin name.
			'oops'                            => __( 'Something went wrong with the plugin API.', 'cyberchimps_elements' ),
			'notice_can_install_required'     => _n_noop(
				'This theme requires the following plugin: %1$s.',
				'This theme requires the following plugins: %1$s.',
				'cyberchimps_elements'
			), // %1$s = plugin name(s).
			'notice_can_install_recommended'  => _n_noop(
				'This theme recommends the following plugin: %1$s.',
				'This theme recommends the following plugins: %1$s.',
				'cyberchimps_elements'
			), // %1$s = plugin name(s).
			'notice_cannot_install'           => _n_noop(
				'Sorry, but you do not have the correct permissions to install the %1$s plugin.',
				'Sorry, but you do not have the correct permissions to install the %1$s plugins.',
				'cyberchimps_elements'
			), // %1$s = plugin name(s).
			'notice_ask_to_update'            => _n_noop(
				'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
				'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
				'cyberchimps_elements'
			), // %1$s = plugin name(s).
			'notice_ask_to_update_maybe'      => _n_noop(
				'There is an update available for: %1$s.',
				'There are updates available for the following plugins: %1$s.',
				'cyberchimps_elements'
			), // %1$s = plugin name(s).
			'notice_cannot_update'            => _n_noop(
				'Sorry, but you do not have the correct permissions to update the %1$s plugin.',
				'Sorry, but you do not have the correct permissions to update the %1$s plugins.',
				'cyberchimps_elements'
			), // %1$s = plugin name(s).
			'notice_can_activate_required'    => _n_noop(
				'The following required plugin is currently inactive: %1$s.',
				'The following required plugins are currently inactive: %1$s.',
				'cyberchimps_elements'
			), // %1$s = plugin name(s).
			'notice_can_activate_recommended' => _n_noop(
				'The following recommended plugin is currently inactive: %1$s.',
				'The following recommended plugins are currently inactive: %1$s.',
				'cyberchimps_elements'
			), // %1$s = plugin name(s).
			'notice_cannot_activate'          => _n_noop(
				'Sorry, but you do not have the correct permissions to activate the %1$s plugin.',
				'Sorry, but you do not have the correct permissions to activate the %1$s plugins.',
				'cyberchimps_elements'
			), // %1$s = plugin name(s).
			'install_link'                    => _n_noop(
				'Begin installing plugin',
				'Begin installing plugins',
				'cyberchimps_elements'
			),
			'update_link' 					  => _n_noop(
				'Begin updating plugin',
				'Begin updating plugins',
				'cyberchimps_elements'
			),
			'activate_link'                   => _n_noop(
				'Begin activating plugin',
				'Begin activating plugins',
				'cyberchimps_elements'
			),
			'return'                          => __( 'Return to Required Plugins Installer', 'cyberchimps_elements' ),
			'plugin_activated'                => __( 'Plugin activated successfully.', 'cyberchimps_elements' ),
			'activated_successfully'          => __( 'The following plugin was activated successfully:', 'cyberchimps_elements' ),
			'plugin_already_active'           => __( 'No action taken. Plugin %1$s was already active.', 'cyberchimps_elements' ),  // %1$s = plugin name(s).
			'plugin_needs_higher_version'     => __( 'Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'cyberchimps_elements' ),  // %1$s = plugin name(s).
			'complete'                        => __( 'All plugins installed and activated successfully. %1$s', 'cyberchimps_elements' ), // %s = dashboard link.
			'contact_admin'                   => __( 'Please contact the administrator of this site for help.', 'cyberchimps_elements' ),

			'nag_type'                        => 'updated', // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
		),		
	);
	tgmpa( $plugins, $config );
}
// Slidedeck integration - Validate License Key
// Commented by Manju - as decided to not give automatic updates
/* add_action('after_switch_theme','cc_slidedeck_key_check');
function cc_slidedeck_key_check()
{
   $slidedeck_options_field = get_option('slidedeck2_global_options');
   if(empty($slidedeck_options_field['license_key']))
   {
     
     $slidedeck_options_field['license_key'] = '4ed497015ff3be31af5756050ff639c8';
     
   }
   update_option('slidedeck2_global_options',$slidedeck_options_field);
   
} */