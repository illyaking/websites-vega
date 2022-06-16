<?php
/**
 * Title: Shortcode[cc_tooltip]
 *
 * Description: Defines markup for shortcode [cc_tooltip], handles parameters passed in the shortcode.
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

function cyberchimps_shortcodes_tooltip( $atts, $content = null ) {

	// Extract parameters passed in the shortcode
	extract( shortcode_atts( array(
		'name'		=> 'cyberchimps_tooltip',
		'position'	=> 'top',
		'title'		=> 'tooltip title',
		'href'		=> '#'
	), $atts ) );

	// Markup for Tooltip
	$html = '<a id="' . $name . '" data-placement="' . $position . '" data-toggle="tooltip" href="#" data-original-title="' .
		$title . '">' . do_shortcode( $content ) . '</a>';
	?>

	<!-- Trigger the tooltip -->
	<script>
		jQuery(function () {
			jQuery('#<?php echo $name; ?>').tooltip();
		});
	</script>

	<?php
	return $html;
}

add_shortcode( 'cc_tooltip', 'cyberchimps_shortcodes_tooltip' );
?>