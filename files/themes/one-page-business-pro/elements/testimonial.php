<?php
/**
 * Title: Testimonial Element
 *
 * Description: Defines custom post type "testimonial".
 *                Defines action to be done when element "testimonial" is active.
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

// Don't load directly
if( !defined( 'ABSPATH' ) ) {
	die( '-1' );
}

if( !class_exists( 'CyberChimpsTestimonial' ) ) {
	class CyberChimpsTestimonial {

		protected static $instance;
		public $options;

		/* Static Singleton Factory Method */
		public static function instance() {
			if( !isset( self::$instance ) ) {
				$className      = __CLASS__;
				self::$instance = new $className;
			}

			return self::$instance;
		}

		/**
		 * Initializes plugin variables and sets up WordPress hooks/actions.
		 *
		 * @return void
		 */
		protected function __construct() {
			add_action( 'testimonial', array( $this, 'render_display' ) );
			$this->options = get_option( 'cyberchimps_options' );
			add_action( 'init', array( $this, 'cyberchimps_init_testimonial_post_type' ) );
		}

		//Define Custom post type
		function cyberchimps_init_testimonial_post_type() {

			register_post_type( 'testimonial_posts',
			                    array(
				                    'labels'      => array(
					                    'name'               => __( 'Testimonial', 'cyberchimps_elements' ),
					                    'singular_name'      => __( 'Testimonial item', 'cyberchimps_elements' ),
					                    'add_new_item'       => __( 'Add new Testimonial item', 'cyberchimps_elements' ),
					                    'edit_item'          => __( 'Edit Testimonial item', 'cyberchimps_elements' ),
					                    'new_item'           => __( 'New Testimonial item', 'cyberchimps_elements' ),
					                    'view_item'          => __( 'View Testimonial item', 'cyberchimps_elements' ),
					                    'search_items'       => __( 'Search Testimonial items', 'cyberchimps_elements' ),
					                    'not_found'          => __( 'No Testimonial items found', 'cyberchimps_elements' ),
					                    'not_found_in_trash' => __( 'No Testimonial items found in trash', 'cyberchimps_elements' )
				                    ),
				                    'public'      => true,
				                    'show_ui'     => true,
				                    'supports'    => array( 'custom-fields', 'title' ),
				                    'taxonomies'  => array( 'testimonial_categories' ),
				                    'has_archive' => false,
				                    //'menu_icon'   => get_template_directory_uri() . '/cyberchimps/lib/images/custom-types/carousel.png',
				                    'rewrite'     => false
			                    )
			);

			$labels = array(
				'name'              => _x( 'Testimonial Categories', 'taxonomy general name', 'cyberchimps_elements' ),
				'singular_name'     => _x( 'Testimonial Category', 'taxonomy singular name', 'cyberchimps_elements' ),
				'search_items'      => __( 'Search Testimonial', 'cyberchimps_elements' ),
				'all_items'         => __( 'All Testimonial', 'cyberchimps_elements' ),
				'parent_item'       => __( 'Testimonial Category', 'cyberchimps_elements' ),
				'parent_item_colon' => __( 'Testimonial Category:', 'cyberchimps_elements' ),
				'edit_item'         => __( 'Edit Testimonial Category', 'cyberchimps_elements' ),
				'update_item'       => __( 'Update Testimonial Category', 'cyberchimps_elements' ),
				'add_new_item'      => __( 'Add New Testimonial Category', 'cyberchimps_elements' ),
				'new_item_name'     => __( 'New Testimonial Category Name', 'cyberchimps_elements' ),
				'menu_name'         => __( 'Testimonial Category', 'cyberchimps_elements' )
			);

			register_taxonomy( 'testimonial_categories', array( 'testimonial_posts' ), array(
				'public'            => true,
				'show_in_nav_menus' => false,
				'hierarchical'      => true,
				'labels'            => $labels,
				'show_ui'           => true
			) );

			/**
			 * Set up Meta Boxes on Box custom post type
			 */

			$testimonial_fields = array( array(
				'type'  => 'single_image',
				'id'    => 'testimonial_post_image',
				'class' => '',
				'name'  => __( 'Testimonial Image', 'cyberchimps_elements' ),
				'std'   => ''
			),
				array(
					'type'  => 'text',
					'id'    => 'testimonial_author_name',
					'class' => '',
					'name'  => __( 'Testimonial Author Name', 'cyberchimps_elements' )
				),
				array(
					'type'  => 'text',
					'id'    => 'testimonial_text',
					'class' => '',
					'name'  => __( 'Testimonial Text', 'cyberchimps_elements' )
				),

			);
			/*
			 * configure your meta box
			 */
			$testimonial_config = array(
				'id'             => 'testimonial_options', // meta box id, unique per meta box
				'title'          => __( 'Featured Post Testimonial', 'cyberchimps_elements' ), // meta box title
				'pages'          => array( 'testimonial_posts' ), // post types, accept custom post types as well, default is array('post'); optional
				'context'        => 'normal', // where the meta box appear: normal (default), advanced, side; optional
				'priority'       => 'high', // order of meta box: high (default), low; optional
				'fields'         => apply_filters( 'cyberchimps_testimonial_single_metabox_fields', $testimonial_fields), // list of meta fields (can be added by field arrays)
				'local_images'   => false, // Use local or hosted images (meta box images for add/remove)
				'use_with_theme' => true //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
			);

			/*
			 * Initiate your meta box
			 */
			$testimonial_meta = new Cyberchimps_Meta_Box( $testimonial_config );

			/**
			 * Set up Meta Boxes on Page
			 *
			 */

			$testimonial_terms = get_terms( 'testimonial_categories', 'hide_empty=0' );
			if( !is_wp_error( $testimonial_terms ) ) {
				foreach( $testimonial_terms as $term ) {
					$testimonial_options[$term->slug] = $term->name;
				}
			}
			else {
				$testimonial_options = null;
			}

			$page_fields = array(
				array(
					'type'    => 'select',
					'id'      => 'testimonial_category',
					'class'   => '',
					'name'    => __( 'Testimonial Category', 'cyberchimps_elements' ),
					'options' => ( isset( $testimonial_options ) ) ? $testimonial_options : array( 'cc_no_options' => __( 'You need to create a Category', 'cyberchimps_core' ) )
				),
				array(
					'type'    => 'single_image',
					'id'      => 'testimonial_background',
					'desc'    => __('Best suited image size is 1280px * 375px', 'cyberchimps_elements'),
					'class'   => '',
					'name'    => __( 'Testimonial Background', 'cyberchimps_elements' )
				)

			);
			/*
			 * configure your meta box
			 */
			$page_config = array(
				'id'             => 'testimonial_options', // meta box id, unique per meta box
				'title'          => __( 'Testimonial Options', 'cyberchimps_elements' ), // meta box title
				'pages'          => array( 'page' ), // post types, accept custom post types as well, default is array('post'); optional
				'context'        => 'normal', // where the meta box appear: normal (default), advanced, side; optional
				'priority'       => 'high', // order of meta box: high (default), low; optional
				'fields'         => apply_filters( 'cyberchimps_testimonial_metabox_fields', $page_fields, 'testimonial' ), // list of meta fields (can be added by field arrays)
				'local_images'   => false, // Use local or hosted images (meta box images for add/remove)
				'use_with_theme' => true //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
			);

			/*
			 * Initiate your meta box
			 */
			$page_meta = new Cyberchimps_Meta_Box( $page_config );
		}

		/**
		 * Puts markup for testimonial
		 *
		 * @return void
		 */
		public function render_display() {

			// Get the default image of carousel
			$default = get_template_directory_uri() . apply_filters( 'cyberchimps_testimonial_img', '/cyberchimps/lib/images/testimonial.jpg' );
			$custombackground = cyberchimps_get_option('testimonial_background');

			if( is_page() ) {
				$customcategory = get_post_meta( get_the_ID(), 'testimonial_category', true );
				$custombackground = get_post_meta( get_the_ID(), 'testimonial_background', true );			

				if($custombackground == ""){
?>
					<style type="text/css" media="all">
						#testimonial_section{ 
							background : url("<?php echo $default; ?>") no-repeat scroll 0 0 / cover;
						}	
					</style>
<?php
				}
				else{
?>
					<style type="text/css" media="all">
						#testimonial_section{ 
							background : url("<?php echo $custombackground; ?>") no-repeat scroll 0 0 / cover;
						}	
					</style>
<?php
				}			
			}

			else {
				
				$customcategory_obj     = ( isset( $this->options['testimonial_categories'] ) ) ? get_term( $this->options['testimonial_categories'], 'testimonial_categories' ) : '';
				$customcategory     = ( isset( $this->options['testimonial_categories'] ) ) ? $customcategory_obj->slug : '';
				$custombackground        = $this->options['testimonial_background'];
			}
	
				$args = array(
					'numberposts'         => -1,
					'offset'              => 0,
					'testimonial_categories' => $customcategory,
					'testimonial_background' => $custombackground,
					'orderby'             => 'post_date',
					'order'               => 'ASC',
					'post_type'           => 'testimonial_posts',
					'post_status'         => 'publish',
					'suppress_filters'    => false
				);
		
				$testimonial_posts = get_posts( $args );
			?>
			<div id="testimonial_container" class="row">
				<div id="testimonial" class="col-lg-12">
					<div id="gallery-testimonial" class="carousel slide portfolio-section" data-ride="carousel">

						<?php

						if( $testimonial_posts ) { 
							$slide_counter1 = 1; ?>
							 <div role="listbox" class="carousel-inner">

						<?php	foreach( $testimonial_posts as $post ) {

								/* Post-specific variables */
								$image    = get_post_meta( $post->ID, 'testimonial_post_image', true );
								$title    = $post->post_title;
								$testimonial_author    = get_post_meta( $post->ID, 'testimonial_author_name', true );
								$testimonial_text    = get_post_meta( $post->ID, 'testimonial_text', true );
						?>
								
								<div class="testimonial_main_div item <?php echo ( $slide_counter1 == 1 ) ? "active" : ""; ?>">
	                                                            <div class="testimonial_img col-lg-12 "><img src="<?php echo $image; ?>" alt="<?php echo $title; ?>"/></div>
								    <div class="testimonial_author col-lg-12">
									<?php echo $testimonial_author; ?>
								    </div>
								    <div class="testimonial_text col-lg-12">
									<?php echo $testimonial_text; ?>
								    </div>
								    
								</div>
								
								
						<?php
							$slide_counter1++;
							}// end of foreach ?>
							
							</div> <!-- end of carousel-inner-->
							<a class="carousel-control left slider-left" href="#gallery-testimonial" data-slide="prev">
								<span class="glyphicon glyphicon-chevron-left"></span>
							</a>
							<a class="carousel-control right slider-right" href="#gallery-testimonial" data-slide="next">
								<span class="glyphicon glyphicon-chevron-right"></span>
							</a>
					<?php	} // end of if
						else {
							$image = get_template_directory_uri() . "/cyberchimps/lib/images/portfolio.jpg";
							?>
							<div class="testimonial_main_div item">
		                            			<div class="testimonial_img col-lg-12 ">	
									<img src="<?php echo $image; ?>" alt="<?php if(!empty($title)) echo $title; ?>"/>
								</div>
								<div class="testimonial_author col-lg-12">Testimonial Author
								</div>
								<div class="testimonial_text col-lg-12">Sample Text
								</div>
							</div>

						<?php } ?>
						
					</div>
					<!-- .es-carousel -->
				</div>
				<!-- #carousel -->
			</div><!-- #container -->
		<?php
		}
	}
}
CyberChimpsTestimonial::instance();
