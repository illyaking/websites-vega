<?php
/**
 * Title: Parallax Element
 *
 * Description: Adds parallax effect to different elements.
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
if ( !defined( 'ABSPATH' ) ) {
	die( '-1' );
}

if ( !class_exists( 'CyberchimpsParallax' ) ) {
	class CyberChimpsParallax {

		protected static $instance;
		public $options, $elements, $parallax_speed, $random_number;

		/* Static Singleton Factory Method */
		public static function instance() {
			if ( !isset( self::$instance ) ) {
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

			// Set list of elements for which parallax options will be added.
			$this->elements = array(
				array( 'name' => 'slider', 'section' => 'page_slider_section' ),
				array( 'name' => 'callout', 'section' => 'callout_section_section' ),
				array( 'name' => 'html_box', 'section' => 'html_box_section' ),
				array( 'name' => 'carousel', 'section' => 'carousel_section_section' ),
				array( 'name' => 'portfolio_pro', 'section' => 'portfolio_pro_section' ),
				array( 'name' => 'recent_posts', 'section' => 'recent_posts_section' ),
				array( 'name' => 'boxes', 'section' => 'boxes_section' ),
				array( 'name' => 'magazine', 'section' => 'magazine_section' ),
				array( 'name' => 'product', 'section' => 'product_element_section' ),
				array( 'name' => 'twitter_api', 'section' => 'twitterbar_section_section' ),
				array( 'name' => 'twitter_bar', 'section' => 'twitterbar_section_section' ),
				array( 'name' => 'widgets', 'section' => 'widgets_section_section' )
			);

			$this->parallax_speed = array(
				'0.1' => '0.1',
				'0.2' => '0.2',
				'0.3' => '0.3',
				'0.4' => '0.4',
				'0.5' => '0.5',
				'0.6' => '0.6',
				'0.7' => '0.7',
				'0.8' => '0.8',
				'0.9' => '0.9',
				'1'   => 1,
			);
			$this->options        = get_option( 'cyberchimps_options' );
			add_action( 'wp_enqueue_scripts', array( $this, 'cyberchimps_parallax_scripts' ) );
			add_action( 'wp_footer', array( $this, 'cyberchimps_parallax_render' ) );
			add_filter( 'cyberchimps_field_filter', array( $this, 'cyberchimps_parallax_fields' ) );

			// Add metabox options for each elements.
			foreach ( $this->elements as $element ) {
				add_filter( 'cyberchimps_' . $element['name'] . '_metabox_fields', array( $this, 'cyberchimps_parallax_metabox_fields' ), 10, 2 );
			}

			// create random number between 1 and 3 inclusive to be able to change the default image
			$this->random_number = rand( 1, 3 );
		}

		/**
		 * Returns the value of the key sent as the name.
		 *
		 * This function is available in the core functions file but elements need to be self sufficient.
		 * TODO this and other common element functions like this need to be set up in their own helper class.
		 *
		 * @param string $name key of options array
		 * @param string $default
		 *
		 * @return value from array or default
		 */
		public function get_option( $name, $default = false ) {
			$options = $this->options;

			if ( isset( $options[$name] ) ) {
				return $options[$name];
			}

			return $default;
		}

		/**
		 * Sets up scripts for parallax
		 */
		public function cyberchimps_parallax_scripts() {

			// Add parallax js library.
			wp_enqueue_script( 'parallax-js', get_template_directory_uri() . '/elements/lib/js/jquery.parallax.min.js', array( 'jquery' ) );
		}

		// Adds parallax options to metabox options of different elements.
		public function cyberchimps_parallax_metabox_fields( $original, $element ) {

			// parallax toggle.
			$original[] = array(
				'type'  => 'checkbox',
				'id'    => 'cyberchimps_page_' . $element . '_parallax',
				'std'   => 1,
				'class' => 'checkbox-toggle',
				'name'  => __( 'Parallax', 'cyberchimps_elements' )
			);

			// parallax image.
			$original[] = array(
				'type'  => 'single_image',
				'id'    => 'cyberchimps_page_' . $element . '_parallax_image',
				'std'   => get_template_directory_uri() . '/images/parallax/parallax' . $this->random_number . '.jpg',
				'class' => 'cyberchimps_page_' . $element . '_parallax-toggle',
				'name'  => __( 'Parallax image', 'cyberchimps_elements' )
			);

			// parallax speed.
			$original[] = array(
				'type'    => 'select',
				'id'      => 'cyberchimps_page_' . $element . '_parallax_speed',
				'class'   => 'cyberchimps_page_' . $element . '_parallax-toggle',
				'name'    => __( 'Parallax speed', 'cyberchimps_elements' ),
				'options' => $this->parallax_speed
			);

			return $original;
		}

		/**
		 * Adds option fields to blog options
		 *
		 * @param $original
		 *
		 * @return mixed
		 */
		public function cyberchimps_parallax_fields( $original ) {

			// Body parallax toggle.
			$new_field[][1] = array(
				'name'    => __( 'Parallax', 'cyberchimps_elements' ),
				'id'      => 'cyberchimps_body_parallax',
				'desc'    => __( 'Set the background image at Appearance > Background to get parallax effect on whole body.', 'cyberchimps_elements' ),
				'type'    => 'toggle',
				'std'     => 1,
				'section' => 'cyberchimps_custom_layout_section',
				'heading' => 'cyberchimps_design_heading'
			);

			// Body parallax scrolling speed.
			$new_field[][2] = array(
				'name'    => __( 'Background scrolling speed', 'cyberchimps_elements' ),
				'id'      => 'cyberchimps_body_parallax_speed',
				'class'      => 'cyberchimps_body_parallax_toggle',
				'type'    => 'select',
				'options' => $this->parallax_speed,
				'section' => 'cyberchimps_custom_layout_section',
				'heading' => 'cyberchimps_design_heading'
			);

			// Add options for each elements.
			foreach ( $this->elements as $element ) {

				// parallax toggle.
				$new_field[][1] = array(
					'name'    => __( 'Parallax', 'cyberchimps_elements' ),
					'id'      => 'cyberchimps_blog_' . $element['name'] . '_parallax',
					'type'    => 'toggle',
					'std'     => 1,
					'section' => 'cyberchimps_' . $element['name'] . '_section',
					'heading' => 'cyberchimps_blog_heading'
				);

				// create random number between 1 and 3 inclusive to be able to change the image
				$random_number = rand( 1, 3 );

				// parallax image.
				$new_field[][2] = array(
					'name'    => __( 'Background image for parallax', 'cyberchimps_elements' ),
					'desc'    => __( 'Enter URL or upload file', 'cyberchimps_elements' ),
					'id'      => 'cyberchimps_blog_' . $element['name'] . '_parallax_image',
					'class'   => 'cyberchimps_blog_' . $element['name'] . '_parallax_toggle',
					'type'    => 'upload',
					'std'     => get_template_directory_uri() . '/images/parallax/parallax' . $this->random_number . '.jpg',
					'section' => 'cyberchimps_' . $element['name'] . '_section',
					'heading' => 'cyberchimps_blog_heading'
				);

				// parallax scrolling speed.
				$new_field[][3] = array(
					'name'    => __( 'Background scrolling speed', 'cyberchimps_elements' ),
					'id'      => 'cyberchimps_blog_' . $element['name'] . '_parallax_speed',
					'class'   => 'cyberchimps_blog_' . $element['name'] . '_parallax_toggle',
					'type'    => 'select',
					'options' => $this->parallax_speed,
					'section' => 'cyberchimps_' . $element['name'] . '_section',
					'heading' => 'cyberchimps_blog_heading'
				);
			}

			$new_fields = cyberchimps_array_field_organizer( $original, $new_field );

			return $new_fields;
		}

		// Set parallax to individual elements by checking toggle.
		public function cyberchimps_parallax_render() {

			global $post;

			// Get body parallax options.
			$body_parallax_toggle = $this->get_option( 'cyberchimps_body_parallax', 1 );
			$body_parallax_speed  = $this->get_option( 'cyberchimps_body_parallax_speed', 0.3 );

			foreach ( $this->elements as $element ) {

				// Get parallax options for elements.
				if ( is_page() ) {
					$parallax_toggle = get_post_meta( $post->ID, 'cyberchimps_page_' . $element['name'] . '_parallax', true );
					$parallax_image  = get_post_meta( $post->ID, 'cyberchimps_page_' . $element['name'] . '_parallax_image', true );
					$parallax_speed  = get_post_meta( $post->ID, 'cyberchimps_page_' . $element['name'] . '_parallax_speed', true );
				}
				else {
					$parallax_toggle = $this->get_option( 'cyberchimps_blog_' . $element['name'] . '_parallax', 1 );
					$parallax_image  = $this->get_option( 'cyberchimps_blog_' . $element['name'] . '_parallax_image', get_template_directory_uri() . '/images/parallax/parallax' .
																													$this->random_number . '.jpg' );
					$parallax_speed  = $this->get_option( 'cyberchimps_blog_' . $element['name'] . '_parallax_speed', 0.5 );
				}
				?>
				<script>
					jQuery(document).ready(function () {
						<?php
						// Add parallax.
						if( $parallax_toggle && $parallax_image ) { ?>
						jQuery('#<?php echo $element['section']?>').css({
							'background-image': 'url("<?php echo $parallax_image?>")',
							'background-size': '100%'
						});
						jQuery('#<?php echo $element['section']?>').parallax('50%', <?php echo $parallax_speed ?>);
						<?php }?>
					});
				</script>
			<?php
			}

			// Add parallax to body.
			if ( $body_parallax_toggle ) {
				?>
				<script>
					jQuery('body').parallax('50%', <?php echo $body_parallax_speed;?>);
				</script>
			<?php
			}
		}
	}
}