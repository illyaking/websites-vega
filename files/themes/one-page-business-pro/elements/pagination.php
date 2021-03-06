<?php
/**
 * Pagination element.
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

if( !class_exists( 'CyberChimpsPagination' ) ) {
	class CyberChimpsPagination {

		protected static $instance;

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
			add_action( 'cyberchimps_after_container', array( $this, 'render_display' ) );
		}

		public function render_display() {
			global $wp_query, $wp_rewrite;
			$wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;

			$pagination = array(
				'base'      => add_query_arg( 'paged', '%#%' ),
				'format'    => '',
				'total'     => $wp_query->max_num_pages,
				'current'   => $current,
				'show_all'  => false,
				'end_size'  => 1,
				'mid_size'  => 2,
				'prev_text' => __( 'Prev', 'cyberchimps_elements' ),
				'next_text' => __( 'Next', 'cyberchimps_elements' ),
				'type'      => 'array'
			);

			if( $wp_rewrite->using_permalinks() ) {
				$pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );
			}

			$pagination['base'] = apply_filters( 'cyberchimp_pagination_base', $pagination['base'] );

			if( !empty( $wp_query->query_vars['s'] ) ) {
				$pagination['add_args'] = array( 's' => urlencode( get_query_var( 's' ) ) );
			}

			$pagination = paginate_links( $pagination );

			// Covert it to array if it is not.
			$blog_section_order = cyberchimps_get_option( 'blog_section_order', array( 'blog_post_page' ) );
			if( is_array( $blog_section_order ) ) {
				$section_order = $blog_section_order;
			}
			else {
				$section_order[] = $blog_section_order;
			}

			$blog_post_page = ( in_array( 'blog_post_page', $section_order ) ) ? 1 : 0;

			if( is_array( $pagination )) {
				echo '<div class="container-full-width" id="pagination">';
				echo '<div class="container">';
				echo '<div class="pagination">';
				echo '<ul>';
				foreach( $pagination as $pag ) {
					/*if ( strpos( $pag, 'dots' ) != false ) {
						continue;
					} else*/
					if( strpos( $pag, 'current' ) != false ) {
						$num = preg_replace( "/[^0-9]/", '', $pag );
						echo '<li class="active"><a>' . $num . '</a></li>';
					}
					else {
						echo '<li>' . $pag . '</li>';
					}
				}
				echo '</ul>';
				echo '</div></div></div>';
			}
		}
	}
}
CyberChimpsPagination::instance();
