<?php
/**
 * Recent Posts Element
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

if( !class_exists( 'CyberChimps_Recent_Posts' ) ) {
	class CyberChimps_Recent_Posts {

		protected static $instance;
		public $location;

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

			add_action( 'recent_posts', array( $this, 'render_display' ) );
			add_action( 'init', array( $this, 'page_options' ) );

		}

		/**
		 * Render the display
		 */
		public function render_display() {
			global $wp_query, $custom_excerpt, $post;
			$custom_excerpt = 'recent';

			if( is_page() ) {
				$title = get_post_meta( $post->ID, 'cyberchimps_recent_posts_title', true );;
				$toggle = get_post_meta( $post->ID, 'cyberchimps_recent_posts_title_toggle', true );;
				$recent_posts_image = get_post_meta( $post->ID, 'cyberchimps_recent_posts_images_toggle', true );;
				$category = get_post_meta( $post->ID, 'cyberchimps_recent_posts_category', true );

			}
			else {
				$title              = cyberchimps_get_option( 'recent_posts_custom_title' );
				$toggle             = cyberchimps_get_option( 'recent_posts_title' );
				$recent_posts_image = cyberchimps_get_option( 'recent_posts_images' );
				if( cyberchimps_get_option( 'recent_posts_post_cats' ) != 'all' ) {
					$category = get_the_category_by_ID( cyberchimps_get_option( 'recent_posts_post_cats' ) );
					//$category = $category[0]->name;
				}
				else {
					$category = 'all';
				}
			}
			if( $category != 'all' ) {
				$blogcategory = $category;
			}
			else {
				$blogcategory = "";
			}

			$args         = array( 'numberposts' => 4, 'post__not_in' => get_option( 'sticky_posts' ), 'category_name' => $blogcategory, 'suppress_filters' => false );
			$recent_posts = get_posts( $args );

			?>
			<div class="row">
				<div id="recent_posts">
					<?php if( $toggle == '1' OR $toggle == 'on' ): ?>
						<h2 class="entry-title"><?php echo $title; ?></h2>
					<?php endif; ?>
					<div id="recent_posts_wrap">

						<?php if( $recent_posts ) :
							foreach( $recent_posts as $post ) : setup_postdata( $post ); ?>
								<div class="col-md-3">
									<div class="recent-posts-container">
										<h3 class="recent-posts-post-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
										<h5 class="recent-posts-byline">
											<span class="byline-time"><?php the_time( get_option( 'date_format' ) ); ?></span> -
											<span class="byline-category"><?php the_category( ', ' ) ?></span> -
											<span class="byline-comments"><?php comments_popup_link( 'No Comments', '1 Comment', '% Comments' ); ?></span>
										</h5>
										<?php
										if( has_post_thumbnail() && $recent_posts_image == '1' OR has_post_thumbnail() && $recent_posts_image == 'on' ) {
											echo '<div class="recent-posts-image">';
											echo '<a href="' . get_permalink( $post->ID ) . '" >';
											the_post_thumbnail( 'small' );
											echo '</a>';
											echo '</div>';
										}
										?>
										<?php add_filter( 'excerpt_more', 'cyberchimps_recent_post_excerpt_more' ); ?>
										<?php the_excerpt(); ?>
										<?php remove_filter( 'excerpt_more', 'cyberchimps_recent_post_excerpt_more' ); ?>
									</div>
								</div>
							<?php endforeach;
							wp_reset_postdata(); ?>

							<div class="clear"></div>

						<?php else : ?>

							<h2>Not Found</h2>

						<?php endif; ?>

					</div>
				</div>
			</div>
		<?php
		}

		public function page_options() {
			/**
			 * Create Meta boxes on page
			 */

			$category_terms = get_terms( 'category', 'hide_empty=0' );
			if( !is_wp_error( $category_terms ) ):
				$blog_options['all'] = "All";
				foreach( $category_terms as $term ) {
					$blog_options[$term->slug] = $term->name;
				}
			endif;

			$page_fields = array(
				array(
					'type'  => 'checkbox',
					'id'    => 'cyberchimps_recent_posts_title_toggle',
					'class' => 'checkbox-toggle',
					'name'  => __( 'Title', 'cyberchimps_elements' )
				),
				array(
					'type'  => 'text',
					'id'    => 'cyberchimps_recent_posts_title',
					'class' => 'cyberchimps_recent_posts_title_toggle-toggle',
					'name'  => __( 'Recent Posts Title', 'cyberchimps_elements' )
				),
				array(
					'type'    => 'select',
					'id'      => 'cyberchimps_recent_posts_category',
					'class'   => '',
					'name'    => __( 'Post Category', 'cyberchimps_elements' ),
					'options' => $blog_options, __( 'All', 'cyberchimps_core' )
				),
				array(
					'type'  => 'checkbox',
					'id'    => 'cyberchimps_recent_posts_images_toggle',
					'class' => 'checkbox',
					'name'  => __( 'Images', 'cyberchimps_elements' )
				)

			);
			/*
			 * configure your meta box
			 */
			$page_config = array(
				'id'             => 'recent_posts_options', // meta box id, unique per meta box
				'title'          => __( 'Recent Posts Options', 'cyberchimps_elements' ), // meta box title
				'pages'          => array( 'page' ), // post types, accept custom post types as well, default is array('post'); optional
				'context'        => 'normal', // where the meta box appear: normal (default), advanced, side; optional
				'priority'       => 'high', // order of meta box: high (default), low; optional
				'fields'         => apply_filters( 'cyberchimps_recent_posts_metabox_fields', $page_fields, 'recent_posts' ), // list of meta fields (can be added by field arrays)
				'local_images'   => false, // Use local or hosted images (meta box images for add/remove)
				'use_with_theme' => true //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
			);

			/*
			 * Initiate your meta box
			 */
			$page_meta = new Cyberchimps_Meta_Box( $page_config );
		}
	}
}
CyberChimps_Recent_Posts::instance();
?>
